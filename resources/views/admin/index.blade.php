@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <div class="d-flex align-items-center justify-content-between">
        <h1 class="font-weight-bold text-dark">
            <i class="fas fa-tachometer-alt mr-2 text-primary"></i> Panel de Control
        </h1>
        <span class="text-muted">Bienvenido, Admin 👋</span>
    </div>
@stop

@section('content')
<div class="row">
    <!-- Cursos en borrador -->
    <div class="col-lg-4 col-6">
        <div class="small-box bg-gradient-warning shadow-lg rounded">
            <div class="inner">
                <h3>{{ $data['courses_draft'] }}</h3>
                <p>Cursos en borrador</p>
            </div>
            <div class="icon">
                <i class="fas fa-book"></i>
            </div>
        </div>
    </div>

    <!-- Cursos en revisión -->
    <div class="col-lg-4 col-6">
        <div class="small-box bg-gradient-info shadow-lg rounded">
            <div class="inner">
                <h3>{{ $data['courses_revision'] }}</h3>
                <p>Cursos en revisión</p>
            </div>
            <div class="icon">
                <i class="fas fa-clipboard-check"></i>
            </div>
        </div>
    </div>

    <!-- Cursos publicados -->
    <div class="col-lg-4 col-6">
        <div class="small-box bg-gradient-success shadow-lg rounded">
            <div class="inner">
                <h3>{{ $data['courses_published'] }}</h3>
                <p>Cursos publicados</p>
            </div>
            <div class="icon">
                <i class="fas fa-check-circle"></i>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Estudiantes -->
    <div class="col-lg-4 col-6">
        <div class="small-box bg-gradient-primary shadow-lg rounded">
            <div class="inner">
                <h3>{{ $data['students_count'] }}</h3>
                <p>Estudiantes</p>
            </div>
            <div class="icon">
                <i class="fas fa-user-graduate"></i>
            </div>
        </div>
    </div>

    <!-- Instructores -->
    <div class="col-lg-4 col-6">
        <div class="small-box bg-gradient-secondary shadow-lg rounded">
            <div class="inner">
                <h3>{{ $data['instructors_count'] }}</h3>
                <p>Instructores</p>
            </div>
            <div class="icon">
                <i class="fas fa-chalkboard-teacher"></i>
            </div>
        </div>
    </div>

    <!-- Administradores -->
    <div class="col-lg-4 col-6">
        <div class="small-box bg-gradient-dark shadow-lg rounded">
            <div class="inner">
                <h3>{{ $data['admins_count'] }}</h3>
                <p>Administradores</p>
            </div>
            <div class="icon">
                <i class="fas fa-user-shield"></i>
            </div>
        </div>
    </div>
</div>

<!-- Ventas e ingresos -->
<div class="row mt-4">
    <div class="col-md-6">
        <x-adminlte-card title="Ventas Totales" theme="info" icon="fas fa-shopping-cart" body-class="text-center">
            <h3 class="font-weight-bold text-info">{{ $salesData->sum('total_sales') }} ventas</h3>
        </x-adminlte-card>
    </div>
    <div class="col-md-6">
        <x-adminlte-card title="Ingresos Totales" theme="success" icon="fas fa-dollar-sign" body-class="text-center">
            <h3 class="font-weight-bold text-success">${{ number_format($salesData->sum('total_revenue'), 2) }}</h3>
        </x-adminlte-card>
    </div>
</div>

<!-- Gráfica -->
<div class="row mt-4">
    <div class="col-md-12">
        <x-adminlte-card title="Ventas por Mes y Año" theme="dark" icon="fas fa-chart-bar">
            <canvas id="salesChart" height="120"></canvas>
        </x-adminlte-card>
    </div>
</div>

<!-- Cursos y Clientes -->
<div class="row mt-4">
    <div class="col-md-6">
        <x-adminlte-card title="Cursos Más Vendidos" theme="info" icon="fas fa-star">
            <ul class="list-group list-group-flush">
                @foreach($mostPurchasedCourses as $course)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        {{ $course->title }}
                        <span class="badge badge-pill badge-primary px-3">{{ $course->buyers->count() }}</span>
                    </li>
                @endforeach
            </ul>
        </x-adminlte-card>
    </div>

    <div class="col-md-6">
        <x-adminlte-card title="Top Clientes" theme="success" icon="fas fa-user">
            <ul class="list-group list-group-flush">
                @foreach($topCustomers as $customer)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <strong>{{ $customer->name }}</strong>
                        <span class="badge badge-pill badge-success px-3">{{ $customer->courses_enrolled_count }}</span>
                    </li>
                @endforeach
            </ul>
        </x-adminlte-card>
    </div>
</div>
@stop

@section('js')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const salesData = @json($salesData);
    const labels = salesData.map(item => `${item.month}/${item.year}`);
    const monthlySales = salesData.map(item => item.total_sales);

    const ctx = document.getElementById('salesChart').getContext('2d');
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: 'Ventas Mensuales',
                data: monthlySales,
                fill: true,
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                tension: 0.3
            }]
        },
        options: {
            responsive: true,
            plugins: {
                tooltip: { mode: 'index', intersect: false },
                legend: { display: true }
            },
            scales: {
                y: { beginAtZero: true }
            }
        }
    });
</script>
@stop
