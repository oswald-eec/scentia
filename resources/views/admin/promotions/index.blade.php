@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1 class="text-primary-emphasis font-weight-bold">Gestión de Promociones</h1>
@stop

@section('content')
    <div class="card shadow-sm border-0">
        {{-- Mensaje de éxito --}}
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="card-title mb-0">Listado de Promociones</h3>
            <div class="ml-auto">
                <a href="{{ route('admin.promotions.create') }}" class="btn btn-outline-primary">
                    <i class="fas fa-plus mr-1"></i> Crear Promocion
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
                    @foreach ($promotions as $promotion)
                        <tr class="text-center">
                            <td>
                                {{ $promotion->id }}
                            </td>
                            <td>
                                {{ $promotion->name }}
                            </td>
                            <td >
                                <a class="btn btn-sm btn-outline-secondary mr-2" href="{{ route('admin.promotions.edit', $promotion) }}">
                                    <i class="fas fa-edit"></i> Editar
                                </a>
                                <form action="{{ route('admin.promotions.destroy', $promotion) }}" method="POST" class="d-inline">
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
