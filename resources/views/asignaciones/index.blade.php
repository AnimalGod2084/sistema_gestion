<x-app-layout>
    <x-slot name="header">
        <h2 class="fs-4 fw-bold text-dark">Asignaciones</h2>
    </x-slot>

    <div class="card card-dashboard">
        <div class="card-header bg-white d-flex justify-content-between align-items-center">
            <span>Lista de Asignaciones</span>
            <a href="{{ route('asignaciones.create') }}" class="btn btn-dark btn-sm">
                <i class="bi bi-plus-lg"></i> Nueva Asignacion
            </a>
        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Fecha</th>
                            <th>Trabajador</th>
                            <th>Tarea</th>
                            <th>Descripcion</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($asignaciones as $asignacion)
                            <tr>
                                <td>{{ $asignacion->id }}</td>
                                <td>{{ $asignacion->fecha->format('d/m/Y') }}</td>
                                <td>{{ $asignacion->user->name }}</td>
                                <td>{{ $asignacion->tarea }}</td>
                                <td>{{ $asignacion->descripcion }}</td>
                                <td>
                                    @if($asignacion->estado == 'pendiente')
                                        <span class="badge bg-warning">Pendiente</span>
                                    @elseif($asignacion->estado == 'completada')
                                        <span class="badge bg-success">Completada</span>
                                    @else
                                        <span class="badge bg-secondary">Cancelada</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('asignaciones.show', $asignacion->id) }}" class="btn btn-sm btn-outline-dark">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="{{ route('asignaciones.edit', $asignacion->id) }}" class="btn btn-sm btn-outline-dark">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('asignaciones.destroy', $asignacion->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('¿Estas seguro de eliminar esta asignacion?')">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted py-4">
                                    No hay asignaciones registradas
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
