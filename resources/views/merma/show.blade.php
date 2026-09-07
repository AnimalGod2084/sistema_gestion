<x-app-layout>
    <x-slot name="header">
        <h2 class="fs-4 fw-bold text-dark">Detalle Merma #{{ $id }}</h2>
    </x-slot>

    <div class="card card-dashboard">
        <div class="card-header bg-white">Informacion de la Merma</div>
        <div class="card-body">
            <p class="text-muted">Detalle de la merma #{{ $id }}</p>
            <a href="{{ route('merma.index') }}" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> Volver</a>
        </div>
    </div>
</x-app-layout>
