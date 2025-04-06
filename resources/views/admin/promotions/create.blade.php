@extends('adminlte::page')

@section('title', 'Crear Promoción')

@section('content_header')
    <h1 class="text-primary-emphasis font-weight-bold">Nueva Promoción</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            {{-- Formulario para crear promoción --}}
            {!! Form::open(['route' => 'admin.promotions.store', 'files' => true]) !!}
                
                {{-- Nombre --}}
                <div class="form-group">
                    {!! Form::label('name', 'Nombre de la Promoción') !!}
                    {!! Form::text('name', old('name'), ['class' => 'form-control', 'placeholder' => 'Ingrese el nombre']) !!}
                    @error('name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Imagen --}}
                <div class="form-group">
                    {!! Form::label('image', 'Imagen de la Promoción') !!}
                    {!! Form::file('image', ['class' => 'form-control-file', 'accept' => 'image/*', 'id' => 'imageInput']) !!}
                    <p class="text-sm text-gray-500 mt-1">Sube una imagen clara y relevante de tu promocion. Requisitos importantes: 1200x500 píxeles; .jpg, .jpeg, .gif o .png.</p>
                    @error('image')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                    {{-- Vista previa de la imagen --}}
                    <div class="mt-3">
                        <img id="imagePreview" src="#" alt="Vista previa de la imagen" class="img-thumbnail d-none" width="200">
                    </div>
                </div>

                {{-- Descripción --}}
                <div class="form-group">
                    {!! Form::label('description', 'Descripción') !!}
                    {!! Form::textarea('description', old('description'), ['class' => 'form-control', 'rows' => 3, 'placeholder' => 'Ingrese una descripción breve']) !!}
                    @error('description')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Botón para enviar --}}
                <div class="text-right">
                    {!! Form::submit('Crear Promoción', ['class' => 'btn btn-primary']) !!}
                </div>

            {!! Form::close() !!}
        </div>
    </div>
@stop

@section('js')
    <script>
        document.getElementById('imageInput').addEventListener('change', function(event) {
            let reader = new FileReader();
            reader.onload = function() {
                let output = document.getElementById('imagePreview');
                output.src = reader.result;
                output.classList.remove('d-none');
            };
            reader.readAsDataURL(event.target.files[0]);
        });
    </script>
@stop
