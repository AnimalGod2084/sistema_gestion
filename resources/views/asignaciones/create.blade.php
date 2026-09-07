<x-app-layout>
    <x-slot name="header">
        <h2 class="fs-4 fw-bold text-dark">Nueva Asignacion</h2>
    </x-slot>

    <div class="card card-dashboard">
        <div class="card-header bg-white">Registrar Asignacion</div>
        <div class="card-body">
            <form method="POST" action="{{ route('asignaciones.store') }}">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Trabajador</label>
                    <select class="form-select" name="user_id" required>
                        <option value="">Seleccionar trabajador</option>
                        @foreach($usuarios as $usuario)
                            <option value="{{ $usuario->id }}">{{ $usuario->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Fecha</label>
                    <input type="date" class="form-control" name="fecha" value="{{ date('Y-m-d') }}" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Tarea</label>
                    <select class="form-select" name="tarea" required>
                        <option value="">Seleccionar tarea</option>
                        <option value="Reponer stock">Reponer stock</option>
                        <option value="Hacer pedidos">Hacer pedidos</option>
                        <option value="Organizar almacen">Organizar almacen</option>
                        <option value="Revision de inventario">Revision de inventario</option>
                        <option value="Limpieza">Limpieza</option>
                        <option value="Otra">Otra</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Descripcion</label>
                    <textarea class="form-control" name="descripcion" rows="3" placeholder="Detalles adicionales de la tarea..."></textarea>
                </div>
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-dark"><i class="bi bi-check-lg"></i> Guardar</button>
                    <a href="{{ route('asignaciones.index') }}" class="btn btn-secondary">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
