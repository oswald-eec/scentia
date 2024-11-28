@extends('adminlte::page')

@section('title', 'Editar Usuario')

@section('content_header')
    <h1 class="text-primary font-weight-bold">Editar Rol</h1>
@stop

@section('content')
    <div class="card shadow-sm border-0">
        <div class="card-body">
            <h5 class="font-weight-bold">Nombre:</h5>
            <p class="form-control-plaintext">{{ $user->name }}</p>

            <h5 class="font-weight-bold mt-3">Lista de Roles:</h5>
            {!! Form::model($user, ['route' => ['admin.users.update', $user], 'method' => 'PUT']) !!}
                <div class="form-group">
                    <div class="row">
                        @foreach ($roles as $role)
                            <div class="col-md-4 col-sm-6 my-1">
                                <label class="d-flex align-items-center font-weight-normal">
                                    {!! Form::checkbox('roles[]', $role->id, null, ['class' => 'mr-2']) !!}
                                    {{ $role->name }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- Botones de acción centrados --}}
                <div class="form-group d-flex justify-content-center mt-4">
                    {!! Form::submit('Asignar Rol', ['class' => 'btn btn-primary px-4 mr-2']) !!}
                    <a href="{{ route('admin.users.index') }}" class="btn btn-secondary px-4">Cancelar</a>
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