@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
<div class="card shadow-sm mt-4">
    <div class="card-header bg-dark text-white">
        <h5 class="mb-0">Editar Nivel</h5>
    </div>
    <div class="card-body">
        {!! Form::model($level, ['route' => ['admin.levels.update', $level], 'method' => 'put']) !!}
            <div class="mb-3">
                {!! Form::label('name', 'Nombre', ['class' => 'form-label']) !!}
                {!! Form::text('name', null, [
                    'class' => 'form-control',
                    'placeholder' => 'Ingrese el nombre del nivel',
                    'required',
                    'autofocus',
                ]) !!}
                @error('name')
                    <div class="text-danger mt-1">
                        <i class="bi bi-exclamation-circle"></i> {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="d-flex justify-content-end">
                {!! Form::submit('Actualizar Nivel', ['class' => 'btn btn-primary']) !!}
            </div>
        {!! Form::close() !!}
    </div>
</div>
@stop