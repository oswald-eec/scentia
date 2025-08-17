@extends('adminlte::page')

@section('title', 'Editar Subcategoría')

@section('content_header')
    <h1 class="text-primary-emphasis font-weight-bold">Editar Subcategoría</h1>
@stop

@section('content')
<div class="card shadow-sm border-0">
    <div class="card-body">
        {!! Form::model($subcategory, ['route' => ['admin.subcategories.update', $subcategory], 'method' => 'PUT']) !!}

        <div class="form-group">
            {!! Form::label('name', 'Nombre de la Subcategoría') !!}
            {!! Form::text('name', null, ['class' => 'form-control']) !!}
            @error('name') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            {!! Form::label('category_id', 'Categoría Asociada') !!}
            {!! Form::select('category_id', $categories, $subcategory->category_id, [
                'class' => 'form-control',
                'placeholder' => 'Selecciona una categoría'
            ]) !!}
            @error('category_id') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <button class="btn btn-outline-primary" type="submit">
            <i class="fas fa-save"></i> Actualizar
        </button>
        <a href="{{ route('admin.subcategories.index') }}" class="btn btn-outline-secondary">Cancelar</a>

        {!! Form::close() !!}
    </div>
</div>
@stop
