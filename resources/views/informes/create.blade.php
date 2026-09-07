<x-app-layout>
    <x-slot name="header">
        <h2 class="fs-4 fw-bold text-dark">Nuevo Informe</h2>
    </x-slot>

    <div class="card card-dashboard">
        <div class="card-header bg-white">Generar Informe</div>
        <div class="card-body">
            <form method="POST" action="{{ route('informes.store') }}">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Fecha Desde</label>
                    <input type="date" class="form-control" name="fecha_desde" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Fecha Hasta</label>
                    <input type="date" class="form-control" name="fecha_hasta" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Tipo de Informe</label>
                    <select class="form-select" name="tipo" required>
                        <option value="">Seleccione...</option>
                        <option value="entradas">Entradas</option>
                        <option value="asignaciones">Asignaciones</option>
                        <option value="merma">Merma</option>
                        <option value="general">General</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Observaciones</label>
                    <textarea class="form-control" name="observaciones" rows="3"></textarea>
                </div>
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-dark"><i class="bi bi-file-earmark-pdf"></i> Generar</button>
                    <a href="{{ route('informes.index') }}" class="btn btn-secondary">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
