@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1 class="text-primary-emphasis font-weight-bold">Gestión de Niveles</h1>
@stop

@section('content')
<div class="card shadow-sm border-0">

    <div class="card-header d-flex justify-content-between align-items-center">
        <h3 class="card-title mb-0">Listado de Niveles</h3>
        <div class="ml-auto">
            <a href="{{ route('admin.levels.create') }}" class="btn btn-outline-primary">
                <i class="fas fa-plus mr-1"></i> Crear Nivel
            </a>
        </div>
    </div>

    <div class="card-body">
        <table class="table table-hover">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th colspan="2" class="text-right">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($levels as $level)
                    <tr>
                        <td>
                            {{ $level->id }}
                        </td>
                        <td>
                            {{ $level->name }}
                        </td>
                        <td class="text-right">
                            <a class="btn btn-sm btn-outline-secondary mr-2" href="{{ route('admin.levels.edit', $level) }}">
                                <i class="fas fa-edit"></i> Editar
                            </a>
                            <form action="{{ route('admin.levels.destroy', $level) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger" type="submit">
                                    <i class="fas fa-trash"></i> Eliminar
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@stop