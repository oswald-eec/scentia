@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1 class="text-primary-emphasis font-weight-bold">Cursos pendientes</h1>
@stop

@section('content')
    {{-- @if (session('info'))
        <div class="alet alert-success">
            {{ session('info') }}
        </div>
    @endif

    <div class="card shadow-sm mb-4">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Categoría</th>
                        <th scope="col" class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($courses as $course)
                        <tr>
                            <td>{{ $course->id }}</td>
                            <td>{{ $course->title }}</td>
                            <td>{{ $course->category->name }}</td>
                            <td class="text-center">
                                <a href="{{ route('admin.courses.show', $course) }}" class="btn btn-sm btn-outline-primary">
                                    Revisar
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer text-center">
            {{ $courses->links('vendor.pagination.bootstrap-5') }}
        </div>
    </div> --}}

    @if (session('info'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('info') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="card shadow-sm mb-4">
        
        <div class="card-body">
            <table class="table table-hover mb-0">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Categoría</th>
                        <th scope="col" class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($courses as $course)
                        <tr>
                            <td>{{ $course->id }}</td>
                            <td>{{ $course->title }}</td>
                            <td>{{ $course->category->name }}</td>
                            <td class="text-center">
                                <a href="{{ route('admin.courses.show', $course) }}" class="btn btn-sm btn-outline-primary">
                                    Revisar
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer text-center">
            {{ $courses->links('vendor.pagination.bootstrap-5') }}
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