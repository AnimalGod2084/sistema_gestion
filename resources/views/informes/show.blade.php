<x-app-layout>
    <x-slot name="header">
        <h2 class="fs-4 fw-bold text-dark">Detalle Informe #{{ $id }}</h2>
    </x-slot>

    <div class="card card-dashboard">
        <div class="card-header bg-white">Informacion del Informe</div>
        <div class="card-body">
            <p class="text-muted">Detalle del informe #{{ $id }}</p>
            <a href="{{ route('informes.index') }}" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> Volver</a>
        </div>
    </div>
</x-app-layout>
