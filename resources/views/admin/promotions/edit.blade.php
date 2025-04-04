@extends('adminlte::page')

@section('title', 'Editar Promoción')

@section('content_header')
    <h1 class="text-primary-emphasis font-weight-bold">Editar Promoción</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            {!! Form::model($promotion, ['route' => ['admin.promotions.update', $promotion], 'method' => 'PUT', 'files' => true, 'id' => 'promotionForm']) !!}

                {{-- Nombre --}}
                <div class="form-group">
                    {!! Form::label('name', 'Nombre') !!}
                    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el nombre de la promoción', 'id' => 'name']) !!}
                    @error('name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Imagen Actual --}}
                <div class="form-group">
                    {!! Form::label('image_url', 'Imagen Actual') !!}
                    <div>
                        <img id="previewImage" src="{{ asset('storage/' . $promotion->image_url) }}" alt="Imagen actual" class="img-fluid rounded mb-2" width="200">
                    </div>
                </div>

                {{-- Nueva Imagen --}}
                <div class="form-group">
                    {!! Form::label('image', 'Nueva Imagen (Opcional)') !!}
                    {!! Form::file('image', ['class' => 'form-control-file', 'id' => 'image']) !!}
                    @error('image')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Descripción --}}
                <div class="form-group">
                    {!! Form::label('description', 'Descripción') !!}
                    {!! Form::textarea('description', null, ['class' => 'form-control', 'rows' => 3, 'placeholder' => 'Ingrese una breve descripción', 'id' => 'description']) !!}
                    @error('description')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Botón de Guardar --}}
                {!! Form::submit('Actualizar Promoción', ['class' => 'btn btn-primary', 'id' => 'saveButton', 'disabled' => true]) !!}

            {!! Form::close() !!}
        </div>
    </div>
@stop

@section('js')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const form = document.getElementById('promotionForm');
            const saveButton = document.getElementById('saveButton');
            const name = document.getElementById('name');
            const image = document.getElementById('image');
            const description = document.getElementById('description');
            const previewImage = document.getElementById('previewImage');
            const originalValues = {
                name: name.value,
                description: description.value
            };

            function checkForChanges() {
                if (
                    name.value !== originalValues.name || 
                    description.value !== originalValues.description || 
                    image.files.length > 0
                ) {
                    saveButton.removeAttribute('disabled');
                } else {
                    saveButton.setAttribute('disabled', true);
                }
            }

            name.addEventListener('input', checkForChanges);
            description.addEventListener('input', checkForChanges);
            image.addEventListener('change', function () {
                checkForChanges();
                if (image.files.length > 0) {
                    const reader = new FileReader();
                    reader.onload = function (e) {
                        previewImage.src = e.target.result;
                    };
                    reader.readAsDataURL(image.files[0]);
                }
            });
        });
    </script>
@stop
