@extends('adminlte::page')

@section('title', 'Crear Nuevo Rol')

@section('content_header')
    <h1 class="text-primary font-weight-bold">Crear Nuevo Rol</h1>
@stop

@section('content')
    <div class="card shadow-sm border-0">
        <div class="card-body">
            {!! Form::open(['route' => 'admin.roles.store']) !!}

                @include('admin.roles.partials.form')

                {{-- Botón de envío centrado --}}
                <div class="form-group text-center">
                    {!! Form::submit('Crear Rol', ['class' => 'btn btn-primary mt-4 px-5 py-2']) !!}
                </div>

            {!! Form::close() !!}
        </div>
    </div>
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
@stop