<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Payment;
use App\Models\Payout;
use Illuminate\Http\Request;

class ManualPaymentController extends Controller
{
    // Formulario de subida de comprobante
    public function create(Course $course)
    {
        return view('payment.create', compact('course'));
    }

    // Guardar el pago manual con comprobante
    public function store(Request $request)
    {
        
        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'amount' => 'required|numeric|min:1',
            'proof' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $course = Course::findOrFail($request->course_id);
        
        $proofPath = $request->file('proof')->store('proofs', 'public');
        
        Payment::create([
            'user_id' => auth()->id(),
            'course_id' => $course->id,
            'method' => 'airtm',
            'amount' => $request->amount,
            'proof_url' => $proofPath,
            'status' => 'pending',
        ]);
        
        return redirect()->route('courses.index')->with('message', 'Comprobante enviado correctamente. Espera validación.');
    }

    // Panel admin: ver pagos manuales pendientes
    public function adminIndex()
    {
        $payments = Payment::where('method', 'airtm')->where('status', 'pending')->with('user', 'course')->get();

        return view('admin.manual-payments.index', compact('payments'));
    }

    // Aprobar un pago manual (admin)
    public function approve(Payment $payment)
    {
        $payment->update([
            'status' => 'completed',
            'paid_at' => now(),
        ]);

        // Inscribir al estudiante
        $payment->user->courses_enrolled()->attach($payment->course_id);

        // Generar payout (80%/20%)
        Payout::create([
            'payment_id' => $payment->id,
            'instructor_id' => $payment->course->user_id,
            'course_id' => $payment->course_id,
            'total_payment' => $payment->amount,
            'instructor_amount' => $payment->amount * 0.80,
            'platform_amount' => $payment->amount * 0.20,
            'status' => 'pending',
        ]);

        return back()->with('message', 'Pago aprobado e inscripción realizada.');
    }

    // Rechazar pago
    public function reject(Payment $payment)
    {
        $payment->update(['status' => 'failed']);
        return back()->with('message', 'Pago rechazado.');
    }
}
