<x-app-layout>
    <x-slot name="header">
        <h2 class="fs-4 fw-bold text-dark">Detalle Asignacion #{{ $asignacion->id }}</h2>
    </x-slot>

    <div class="card card-dashboard">
        <div class="card-header bg-white">Informacion de la Asignacion</div>
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-6">
                    <strong>Trabajador:</strong>
                    <p>{{ $asignacion->user->name }}</p>
                </div>
                <div class="col-md-6">
                    <strong>Fecha:</strong>
                    <p>{{ $asignacion->fecha->format('d/m/Y') }}</p>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <strong>Tarea:</strong>
                    <p>{{ $asignacion->tarea }}</p>
                </div>
                <div class="col-md-6">
                    <strong>Estado:</strong>
                    <p>
                        @if($asignacion->estado == 'pendiente')
                            <span class="badge bg-warning">Pendiente</span>
                        @elseif($asignacion->estado == 'completada')
                            <span class="badge bg-success">Completada</span>
                        @else
                            <span class="badge bg-secondary">Cancelada</span>
                        @endif
                    </p>
                </div>
            </div>
            <div class="mb-3">
                <strong>Descripcion:</strong>
                <p>{{ $asignacion->descripcion ?: 'Sin descripcion' }}</p>
            </div>
            <a href="{{ route('asignaciones.index') }}" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> Volver</a>
        </div>
    </div>
</x-app-layout>
