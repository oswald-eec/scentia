@extends('adminlte::page')

@section('title', 'Pagos Manuales')

@section('content_header')
    <h1 class="text-primary-emphasis font-weight-bold">Pagos Manuales Pendientes (AirTM)</h1>
@stop

@section('content')
<div class="card shadow-sm border-0">
    <div class="card-header">
        <h3 class="card-title mb-0">Listado de pagos pendientes</h3>
    </div>

    <div class="card-body">
        @if (session('message'))
            <div class="alert alert-success">{{ session('message') }}</div>
        @endif

        <table class="table table-hover table-striped">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Estudiante</th>
                    <th>Curso</th>
                    <th>Monto</th>
                    <th>Comprobante</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($payments as $payment)
                    <tr>
                        <td>{{ $payment->id }}</td>
                        <td>{{ $payment->user->name }}</td>
                        <td>{{ $payment->course->title }}</td>
                        <td>${{ number_format($payment->amount, 2) }}</td>
                        <td>
                            @if($payment->proof_url)
                                <a href="{{ asset('storage/' . $payment->proof_url) }}" target="_blank" class="btn btn-sm btn-outline-info">
                                    <i class="fas fa-image"></i> Ver
                                </a>
                            @else
                                <span class="text-muted">{{ $payment->proof_url }}</span>
                            @endif
                        </td>
                        <td class="d-flex">
                            <form method="POST" action="{{ route('admin.manual-payments.approve', $payment) }}" class="mr-2">
                                @csrf
                                <button class="btn btn-sm btn-outline-success" type="submit">
                                    <i class="fas fa-check-circle"></i> Aprobar
                                </button>
                            </form>

                            <form method="POST" action="{{ route('admin.manual-payments.reject', $payment) }}">
                                @csrf
                                <button class="btn btn-sm btn-outline-danger" type="submit">
                                    <i class="fas fa-times-circle"></i> Rechazar
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">No hay pagos pendientes por revisar.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@stop
