<x-app-layout>
    <x-slot name="header">
        <h2 class="fs-4 fw-bold text-dark">Editar Asignacion #{{ $asignacion->id }}</h2>
    </x-slot>

    <div class="card card-dashboard">
        <div class="card-header bg-white">Editar Asignacion</div>
        <div class="card-body">
            <form method="POST" action="{{ route('asignaciones.update', $asignacion->id) }}">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label class="form-label">Trabajador</label>
                    <select class="form-select" name="user_id" required>
                        <option value="">Seleccionar trabajador</option>
                        @foreach($usuarios as $usuario)
                            <option value="{{ $usuario->id }}" {{ $asignacion->user_id == $usuario->id ? 'selected' : '' }}>
                                {{ $usuario->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Fecha</label>
                    <input type="date" class="form-control" name="fecha" value="{{ $asignacion->fecha->format('Y-m-d') }}" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Tarea</label>
                    <select class="form-select" name="tarea" required>
                        <option value="">Seleccionar tarea</option>
                        <option value="Reponer stock" {{ $asignacion->tarea == 'Reponer stock' ? 'selected' : '' }}>Reponer stock</option>
                        <option value="Hacer pedidos" {{ $asignacion->tarea == 'Hacer pedidos' ? 'selected' : '' }}>Hacer pedidos</option>
                        <option value="Organizar almacen" {{ $asignacion->tarea == 'Organizar almacen' ? 'selected' : '' }}>Organizar almacen</option>
                        <option value="Revision de inventario" {{ $asignacion->tarea == 'Revision de inventario' ? 'selected' : '' }}>Revision de inventario</option>
                        <option value="Limpieza" {{ $asignacion->tarea == 'Limpieza' ? 'selected' : '' }}>Limpieza</option>
                        <option value="Otra" {{ $asignacion->tarea == 'Otra' ? 'selected' : '' }}>Otra</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Estado</label>
                    <select class="form-select" name="estado" required>
                        <option value="pendiente" {{ $asignacion->estado == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                        <option value="completada" {{ $asignacion->estado == 'completada' ? 'selected' : '' }}>Completada</option>
                        <option value="cancelada" {{ $asignacion->estado == 'cancelada' ? 'selected' : '' }}>Cancelada</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Descripcion</label>
                    <textarea class="form-control" name="descripcion" rows="3">{{ $asignacion->descripcion }}</textarea>
                </div>
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-dark"><i class="bi bi-check-lg"></i> Actualizar</button>
                    <a href="{{ route('asignaciones.index') }}" class="btn btn-secondary">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
