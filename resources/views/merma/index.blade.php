<x-app-layout>
    <x-slot name="header">
        <h2 class="fs-4 fw-bold text-dark">Merma</h2>
    </x-slot>

    <div class="card card-dashboard">
        <div class="card-header bg-white d-flex justify-content-between align-items-center">
            <span>Lista de Mermas</span>
            <a href="{{ route('merma.create') }}" class="btn btn-dark btn-sm">
                <i class="bi bi-plus-lg"></i> Nueva Merma
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
                            <th>Producto</th>
                            <th>Cantidad</th>
                            <th>Motivo</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($mermas as $merma)
                            <tr>
                                <td>{{ $merma->id }}</td>
                                <td>{{ $merma->fecha->format('d/m/Y') }}</td>
                                <td>{{ $merma->producto->nombre }}</td>
                                <td>{{ $merma->cantidad }}</td>
                                <td>{{ $merma->motivo }}</td>
                                <td>
                                    <form action="{{ route('merma.destroy', $merma->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('¿Estás seguro de que deseas eliminar esta merma?')">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
