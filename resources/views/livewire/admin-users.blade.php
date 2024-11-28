<div class="container">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-light d-flex align-items-center">
            <input wire:keydown="limpiar_page" 
                   wire:model="search" 
                   class="form-control w-100" 
                   placeholder="Escriba un nombre, email..." 
                   aria-label="Buscar usuario">
        </div>

        @if ($users->count())
            <div class="card-body p-0">
                <table class="table table-hover mb-0">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Email</th>
                            <th scope="col">Cursos Inscritos</th>
                            <th scope="col" class="text-center">Acciones</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->courses_enrolled->count() }}</td>
                                <td class="text-center">
                                    <a class="btn btn-sm btn-primary mr-2" href="{{ route('admin.users.edit', $user) }}">
                                        <i class="fas fa-edit mr-1"></i> Editar
                                    </a>
                                    <button class="btn btn-sm btn-info" data-toggle="modal" data-target="#coursesModal-{{ $user->id }}">
                                        <i class="fas fa-book mr-1"></i> Ver Cursos
                                    </button>

                                    <!-- Modal para ver los cursos -->
                                    <div class="modal fade" id="coursesModal-{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="coursesModalLabel-{{ $user->id }}" aria-hidden="true">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="coursesModalLabel-{{ $user->id }}">Cursos Inscritos de {{ $user->name }}</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <ul class="list-group">
                                                        @forelse ($user->courses_enrolled as $course)
                                                            <li class="list-group-item">{{ $course->title }}</li>
                                                        @empty
                                                            <li class="list-group-item text-muted">No tiene cursos inscritos.</li>
                                                        @endforelse
                                                    </ul>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="card-footer d-flex justify-content-between align-items-center bg-light">
                <span class="text-muted">Mostrando {{ $users->firstItem() }} a {{ $users->lastItem() }} de {{ $users->total() }} usuarios</span>
                {{ $users->links() }}
            </div>
        @else
            <div class="card-body text-center">
                <strong>No se encontraron registros.</strong>
            </div>
        @endif

    </div>
</div>

