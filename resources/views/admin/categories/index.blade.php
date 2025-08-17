@extends('adminlte::page')

@section('title', 'Gestión de Categorías')

@section('content_header')
    <h1 class="text-primary-emphasis font-weight-bold">Gestión de Categorías</h1>
@stop

@section('content')
    <div class="card shadow-sm border-0">

        <!-- HEADER -->
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="card-title mb-0">Listado de Categorías y Subcategorías</h3>
            <div class="ml-auto">
                <a href="{{ route('admin.categories.create') }}" class="btn btn-outline-primary">
                    <i class="fas fa-plus mr-1"></i> Crear Categoría
                </a>
            </div>
        </div>

        <!-- BODY -->
        <div class="card-body p-0">
            <table class="table table-hover table-bordered mb-0">
                <thead class="thead-dark">
                    <tr>
                        <th style="width: 50px">ID</th>
                        <th>Nombre</th>
                        <th style="width: 250px" class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($categories as $category)
                        <!-- FILA DE CATEGORÍA -->
                        <tr class="bg-light">
                            <td>{{ $category->id }}</td>
                            <td class="font-weight-bold text-primary">
                                <i class="fas fa-folder-open mr-1 text-warning"></i>
                                {{ $category->name }}
                            </td>
                            <td class="text-right">
                                <a href="{{ route('admin.subcategories.create', ['category_id' => $category->id]) }}" 
                                   class="btn btn-sm btn-outline-info mr-2">
                                    <i class="fas fa-plus"></i> Subcategoría
                                </a>
                                <a href="{{ route('admin.categories.edit', $category) }}" 
                                   class="btn btn-sm btn-outline-secondary mr-2" data-toggle="tooltip" data-placement="top" title="Editar">
                                    <i class="fas fa-edit"></i>
                                </a>
                                
                                <form action="{{ route('admin.categories.destroy', $category) }}" 
                                      method="POST" class="d-inline"
                                      onsubmit="return confirm('¿Seguro que deseas eliminar esta categoría?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" 
                                            class="btn btn-sm btn-outline-danger"
                                            data-toggle="modal" 
                                            data-target="#deleteModal" 
                                            data-id="{{ $category->id }}"
                                            data-name="{{ $category->name }}"
                                            title="Eliminar">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>

                        <!-- SUBCATEGORÍAS -->
                        @forelse ($category->subcategories as $subcategory)
                            <tr>
                                <td></td>
                                <td class="pl-4">
                                    <i class="fas fa-angle-right text-muted mr-1"></i>
                                    {{ $subcategory->name }}
                                </td>
                                <td class="text-right">
                                    <a href="{{ route('admin.subcategories.edit', $subcategory) }}" 
                                       class="btn btn-sm btn-outline-secondary mr-2" data-toggle="tooltip" data-placement="top" title="Editar">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.subcategories.destroy', $subcategory) }}" 
                                          method="POST" class="d-inline"
                                          onsubmit="return confirm('¿Seguro que deseas eliminar esta subcategoría?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" 
                                                class="btn btn-sm btn-outline-danger"
                                                data-toggle="modal" 
                                                data-target="#deleteModal" 
                                                data-id="{{ $subcategory->id }}"
                                                data-name="{{ $subcategory->name }}"
                                                title="Eliminar">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td></td>
                                <td colspan="2" class="text-muted pl-4">No hay subcategorías registradas</td>
                            </tr>
                        @endforelse
                    @empty
                        <tr>
                            <td colspan="3" class="text-center text-muted">No hay categorías registradas</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Modal de Confirmación -->
        <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="deleteModalLabel">Confirmar Eliminación</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Cerrar">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                ¿Estás seguro de que deseas eliminar la <span id="itemName" class="font-weight-bold"></span>?  
                Esta acción no se puede deshacer.
            </div>
            <div class="modal-footer">
                <form id="deleteForm" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-outline-danger">Eliminar</button>
                </form>
            </div>
            </div>
        </div>
        </div>


        <!-- FOOTER: PAGINACIÓN -->
        <div class="card-footer text-center">
            {{ $categories->links('vendor.pagination.bootstrap-5') }}
        </div>
    </div>
@stop

@section('js')
    <script>
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        });
    </script>
    <script>
        $(function () {
            // Tooltip
            $('[data-toggle="tooltip"]').tooltip();

            // Modal Delete
            $('#deleteModal').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget); 
                var id = button.data('id'); 
                var name = button.data('name');
                var actionUrl = "";

                // Detecta si estamos en categorías o subcategorías
                if (window.location.href.includes("categories")) {
                    actionUrl = "/admin/categories/" + id;
                } else {
                    actionUrl = "/admin/subcategories/" + id;
                }

                var modal = $(this);
                modal.find('#itemName').text(name);
                modal.find('#deleteForm').attr('action', actionUrl);
            });
        });
    </script>
@endsection

