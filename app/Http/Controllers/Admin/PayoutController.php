<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payout;
use Illuminate\Http\Request;

class PayoutController extends Controller
{
    // Mostrar todas las liquidaciones pendientes y pagadas
    public function index()
    {
        $payouts = Payout::with('instructor', 'course')
            ->orderByDesc('created_at')
            ->get();

        return view('admin.payouts.index', compact('payouts'));
    }

    // Marcar una liquidación como pagada
    public function markAsPaid(Payout $payout)
    {
        $payout->update([
            'status' => 'paid',
            'payout_date' => now(),
        ]);

        return back()->with('message', 'Payout marcado como pagado.');
    }
}
