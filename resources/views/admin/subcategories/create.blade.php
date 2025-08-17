@extends('adminlte::page')

@section('title', 'Crear Subcategoría')

@section('content_header')
    <h1 class="text-primary-emphasis font-weight-bold">Crear Subcategoría</h1>
@stop

@section('content')
<div class="card shadow-sm border-0">
    <div class="card-body">
        {!! Form::open(['route' => 'admin.subcategories.store']) !!}

        <div class="form-group">
            {!! Form::label('name', 'Nombre de la Subcategoría') !!}
            {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Ej: Backend']) !!}
            @error('name') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            {!! Form::label('category_id', 'Categoría Asociada') !!}
            {!! Form::select('category_id', $categories, $selectedCategory ?? null, [
                'class' => 'form-control',
                'placeholder' => 'Selecciona una categoría'
            ]) !!}
            @error('category_id') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <button class="btn btn-outline-primary" type="submit">
            <i class="fas fa-save"></i> Guardar
        </button>
        <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-secondary">Cancelar</a>

        {!! Form::close() !!}
    </div>
</div>
@stop
