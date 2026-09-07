<x-app-layout>
    <x-slot name="header">
        <h2 class="fs-4 fw-bold text-dark">Detalle Entrada #{{ $id }}</h2>
    </x-slot>

    <div class="card card-dashboard">
        <div class="card-header bg-white">Informacion de la Entrada</div>
        <div class="card-body">
            <p class="text-muted">Detalle de la entrada #{{ $id }}</p>
            <a href="{{ route('entradas.index') }}" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> Volver</a>
        </div>
    </div>
</x-app-layout>
