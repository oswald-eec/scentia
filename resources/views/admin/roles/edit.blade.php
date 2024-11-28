@extends('adminlte::page')

@section('title', 'Editar Rol')

@section('content_header')
    <h1 class="text-primary font-weight-bold">Editar Rol</h1>
@stop
@section('content')
    <div class="card shadow-sm border-0">
        <div class="card-body">
            {!! Form::model($role, ['route' => ['admin.roles.update', $role], 'method' => 'PUT']) !!}

                {{-- Incluye el formulario parcial con los campos de rol --}}
                @include('admin.roles.partials.form')

                {{-- Botones de Guardar y Cancelar centrados --}}
                <div class="form-group text-center mt-4">
                    {!! Form::submit('Guardar cambios', ['class' => 'btn btn-sm btn-primary fw-bolder px-5 py-2 mr-2']) !!}
                    <a href="{{ route('admin.roles.index') }}" class="btn btn-sm btn-danger fw-bolder px-5 py-2">
                        Cancelar
                    </a>
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