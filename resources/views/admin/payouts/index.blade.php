@extends('adminlte::page')

@section('title', 'Payouts')

@section('content_header')
    <h1 class="text-primary-emphasis font-weight-bold">Gestión de Pagos a Instructores</h1>
@stop

@section('content')
<div class="card shadow-sm border-0">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h3 class="card-title mb-0">Listado de Liquidaciones</h3>
    </div>

    <div class="card-body">
        @if (session('message'))
            <div class="alert alert-success">{{ session('message') }}</div>
        @endif

        <table class="table table-hover table-striped">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Instructor</th>
                    <th>Curso</th>
                    <th>Total</th>
                    <th>Instructor (80%)</th>
                    <th>Plataforma (20%)</th>
                    <th>Estado</th>
                    <th class="text-right">Acción</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($payouts as $payout)
                    <tr>
                        <td>{{ $payout->id }}</td>
                        <td>{{ $payout->instructor->name }}</td>
                        <td>{{ $payout->course->title }}</td>
                        <td>${{ number_format($payout->total_payment, 2) }}</td>
                        <td>${{ number_format($payout->instructor_amount, 2) }}</td>
                        <td>${{ number_format($payout->platform_amount, 2) }}</td>
                        <td>
                            @if ($payout->status === 'paid')
                                <span class="badge badge-success">Pagado</span>
                            @else
                                <span class="badge badge-warning">Pendiente</span>
                            @endif
                        </td>
                        <td class="text-right">
                            @if ($payout->status === 'pending')
                                <form method="POST" action="{{ route('admin.payouts.markAsPaid', $payout) }}">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-outline-success">
                                        <i class="fas fa-check-circle"></i> Marcar como pagado
                                    </button>
                                </form>
                            @else
                                {{-- <small>{{ $payout->payout_date ? $payout->payout_date->format('d/m/Y') : '-' }}</small> --}}
                                <span class="text-muted">Pagado el {{ $payout->payout_date}}</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center">No hay registros de pagos disponibles.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@stop
