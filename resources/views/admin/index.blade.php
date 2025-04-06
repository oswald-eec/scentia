@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Panel de Control</h1>
@stop

@section('content')
<div class="row">
    <!-- Cursos en borrador -->
    <div class="col-lg-4 col-6">
        <div class="small-box bg-warning">
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
        <div class="small-box bg-info">
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
        <div class="small-box bg-success">
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
        <div class="small-box bg-primary">
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
        <div class="small-box bg-secondary">
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
        <div class="small-box bg-dark">
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

<div class="row mt-4">
    <!-- Cuadros de ventas e ingresos -->
    <div class="col-md-6">
        <x-adminlte-card title="Ventas Totales" theme="info" icon="fas fa-shopping-cart">
            <h3 class="text-center">{{ $salesData->sum('total_sales') }} ventas</h3>
        </x-adminlte-card>
    </div>
    <div class="col-md-6">
        <x-adminlte-card title="Ingresos Totales" theme="success" icon="fas fa-dollar-sign">
            <h3 class="text-center">${{ number_format($salesData->sum('total_revenue'), 2) }}</h3>
        </x-adminlte-card>
    </div>
</div>

<div class="row mt-4">
    <!-- Gráfica de Ventas -->
    <div class="col-md-12">
        <x-adminlte-card title="Ventas por Mes y Año" theme="dark" icon="fas fa-chart-bar">
            <canvas id="salesChart"></canvas>
        </x-adminlte-card>
    </div>
</div>

<div class="row mt-4">
    <!-- Cursos más vendidos -->
    <div class="col-md-6">
        <x-adminlte-card title="Cursos Más Vendidos" theme="info" icon="fas fa-star">
            <ul class="list-group">
                @foreach($mostPurchasedCourses as $course)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        {{ $course->title }}
                        <span class="badge badge-primary">{{ $course->buyers->count() }} compras</span>
                    </li>
                @endforeach
            </ul>
        </x-adminlte-card>
    </div>

    <!-- Usuarios con más compras -->
    <div class="col-md-6">
        <x-adminlte-card title="Top Clientes" theme="success" icon="fas fa-user">
            <ul class="list-group">
                @foreach($topCustomers as $customer)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <strong>{{ $customer->name }}</strong>
                        <div>
                            <span class="badge badge-success">Cursos comprados: {{ $customer->courses_enrolled_count }}</span>
                            {{-- @foreach($customer->coursesPurchased as $course)
                                <span class="badge badge-secondary">{{ $course->title }}</span>
                            @endforeach --}}
                        </div>
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
    // Preparar datos para el gráfico
    const salesData = @json($salesData);

    const labels = salesData.map(item => `${item.month}/${item.year}`);
    const monthlySales = salesData.map(item => item.total_sales);
    const annualSales = salesData.reduce((acc, item) => {
        const yearLabel = `${item.year}`;
        acc[yearLabel] = (acc[yearLabel] || 0) + item.total_sales;
        return acc;
    }, {});

    const annualLabels = Object.keys(annualSales);
    const annualTotals = Object.values(annualSales);

    // Configurar el gráfico
    const ctx = document.getElementById('salesChart').getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [
                {
                    label: 'Ventas Mensuales',
                    data: monthlySales,
                    backgroundColor: 'rgba(54, 162, 235, 0.6)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1,
                },
                {
                    label: 'Ventas Anuales',
                    data: annualTotals,
                    backgroundColor: 'rgba(255, 99, 132, 0.6)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1,
                },
            ],
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                },
            },
        },
    });
</script>
@stop
