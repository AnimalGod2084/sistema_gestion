<x-app-layout>
    <x-slot name="header">
        <h2 class="fs-4 fw-bold text-dark">Nueva Entrada</h2>
    </x-slot>

    <div class="card card-dashboard">
        <div class="card-header bg-white">Registrar Entrada</div>
        <div class="card-body">
            <form method="POST" action="{{ route('entradas.store') }}">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Fecha</label>
                    <input type="date" class="form-control" name="fecha" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Descripcion</label>
                    <textarea class="form-control" name="descripcion" rows="3" required></textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">Producto</label>
                    <select class="form-select" name="producto_id" required>
                        <option value="">Seleccione un producto</option>
                        @foreach($productos as $producto)
                            <option value="{{ $producto->id }}">{{ $producto->nombre }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Cantidad</label>
                    <input type="number" class="form-control" name="cantidad" required>
                </div>
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-dark"><i class="bi bi-check-lg"></i> Guardar</button>
                    <a href="{{ route('entradas.index') }}" class="btn btn-secondary">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
