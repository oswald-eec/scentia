@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
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
                <h3>43</h3>
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

<div class="card mt-4">
    <div class="card-header">
        <h3 class="card-title">Estadisticas del Mes</h3>
    </div>
    <div class="card-body">
        <div class="row">
            <!-- Tab Navigation -->
            <div class="col-12">
                <ul class="nav nav-tabs" id="stats-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="top-selling-tab" data-toggle="tab" href="#top-selling" role="tab">Mas Vendidos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="most-popular-tab" data-toggle="tab" href="#most-popular" role="tab">Mas Populares</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="top-customers-tab" data-toggle="tab" href="#top-customers" role="tab">Top Usuarios</a>
                    </li>
                </ul>
            </div>

            <!-- Tab Content -->
            <div class="tab-content col-12 mt-3">
                <!-- Top Selling Courses -->
                <div class="tab-pane fade show active" id="top-selling" role="tabpanel">
                    <ul class="list-group">
                        @foreach($courses as $course)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            {{ $course->title }}
                            <span class="badge badge-success">100 Sales</span>
                        </li>
                        @endforeach
                    </ul>
                </div>

                <!-- Most Popular Courses -->
                <div class="tab-pane fade" id="most-popular" role="tabpanel">
                    <ul class="list-group">
                        @foreach($courses as $course)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            {{ $course->title }}
                            <span class="badge badge-info">5 Stars</span>
                        </li>
                        @endforeach
                    </ul>
                </div>

                <!-- Top Customers -->
                <div class="tab-pane fade" id="top-customers" role="tabpanel">
                    <ul class="list-group">
                        @foreach($users as $customer)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            {{ $customer->name }}
                            <span class="badge badge-primary"> Purchases</span>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>


@stop

{{-- @section('css')
    Add here extra stylesheets
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
@stop --}}

<!-- Dropdown menu -->

<!-- Navbar -->


