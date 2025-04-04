<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Purchase;
use App\Models\User;
use Illuminate\Http\Request;

class HotmartWebhookController extends Controller
{
    public function handle(Request $request)
    {
        $data = $request->all();

        // Verificar firma del Webhook (opcional pero recomendado)
        if (!$this->verifySignature($data)) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $transactionId = $data['transaction'];
        $email = $data['buyer']['email'];
        $courseHotmartId = $data['product']['id'];
        $status = $data['status'];

        // Buscar al usuario por email
        $user = User::where('email', $email)->first();
        if (!$user) return response()->json(['message' => 'User not found'], 404);

        // Buscar el curso por hotmart_id
        $course = Course::where('hotmart_id', $courseHotmartId)->first();
        if (!$course) return response()->json(['message' => 'Course not found'], 404);

        // Crear o actualizar la compra
        $purchase = Purchase::updateOrCreate(
            ['hotmart_transaction_id' => $transactionId],
            [
                'user_id' => $user->id,
                'course_id' => $course->id,
                'price_paid' => $data['price']['amount'],
                'status' => $status == 'approved' ? 'completed' : 'pending',
                'purchased_at' => $status == 'approved' ? now() : null,
            ]
        );

        // Si el pago fue aprobado, inscribir al estudiante
        if ($status == 'approved') {
            $course->students()->syncWithoutDetaching([$user->id]);
        }

        return response()->json(['message' => 'Webhook processed']);
    }

    private function verifySignature($data)
    {
        $hotmartSecret = env('HOTMART_SECRET');
        $signature = $data['signature'] ?? '';

        return hash_hmac('sha256', json_encode($data), $hotmartSecret) === $signature;
    }
}
