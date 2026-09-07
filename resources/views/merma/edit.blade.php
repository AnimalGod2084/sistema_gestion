<x-app-layout>
    <x-slot name="header">
        <h2 class="fs-4 fw-bold text-dark">Editar Merma #{{ $id }}</h2>
    </x-slot>

    <div class="card card-dashboard">
        <div class="card-header bg-white">Editar Merma</div>
        <div class="card-body">
            <form method="POST" action="{{ route('merma.update', $id) }}">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label class="form-label">Fecha</label>
                    <input type="date" class="form-control" name="fecha" value="{{ date('Y-m-d') }}" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Producto</label>
                    <input type="text" class="form-control" name="producto" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Cantidad</label>
                    <input type="number" class="form-control" name="cantidad" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Motivo</label>
                    <textarea class="form-control" name="motivo" rows="3" required></textarea>
                </div>
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-dark"><i class="bi bi-check-lg"></i> Actualizar</button>
                    <a href="{{ route('merma.index') }}" class="btn btn-secondary">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
