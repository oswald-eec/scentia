{{-- Campo de nombre con validación --}}
<div class="form-group">
    {!! Form::label('name', 'Nombre del Rol:', ['class' => 'font-weight-bold']) !!}
    {!! Form::text('name', null, [
        'class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : ''),
        'placeholder' => 'Ej. Administrador'
    ]) !!}
    @error('name')
        <div class="alert alert-danger mt-2 p-1" role="alert">
            <small>{{ $message }}</small>
        </div>
    @enderror
</div>

{{-- Lista de permisos en cuadrícula --}}
<div class="form-group">
    <strong class="font-weight-bold d-block mb-2">Permisos:</strong>

    @error('permissions')
        <div class="alert alert-danger mt-2 p-1" role="alert">
            <small>{{ $message }}</small>
        </div>
    @enderror

    <div class="row">
        @foreach ($permissions as $permission)
            <div class="col-md-4 col-sm-6 mb-2">
                <label class="d-flex align-items-center font-weight-normal">
                    {!! Form::checkbox('permissions[]', $permission->id, null, ['class' => 'mr-2']) !!}
                    {{ $permission->name }}
                </label>
            </div>
        @endforeach
    </div>
</div>