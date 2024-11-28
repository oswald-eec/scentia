@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <div class="card shadow-sm border-0">

        <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="card-title mb-0">Listado de Precios</h3>
            <div class="ml-auto">
                <a href="{{ route('admin.prices.create') }}" class="btn btn-outline-primary">
                    <i class="fas fa-plus mr-1"></i> Crear Precio
                </a>
            </div>
        </div>

        <div class="card-body">
            <table class="table table-hover">
                <thead class="thead-dark">
                    <tr class="text-center">
                        <th>ID</th>
                        <th>Nombre</th>
                        <th colspan="2" >Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($prices as $price)
                        <tr class="text-center">
                            <td>
                                {{ $price->id }}
                            </td>
                            <td>
                                {{ $price->name }}
                            </td>
                            <td >
                                <a class="btn btn-sm btn-outline-secondary mr-2" href="{{ route('admin.prices.edit', $price) }}">
                                    <i class="fas fa-edit"></i> Editar
                                </a>
                                <form action="{{ route('admin.prices.destroy', $price) }}" method="POST" class="d-inline">
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
