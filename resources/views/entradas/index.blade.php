<x-app-layout>
    <x-slot name="header">
        <h2 class="fs-4 fw-bold text-dark">Entradas</h2>
    </x-slot>

    <div class="card card-dashboard">
        <div class="card-header bg-white d-flex justify-content-between align-items-center">
            <span>Lista de Entradas</span>
            <a href="{{ route('entradas.create') }}" class="btn btn-dark btn-sm">
                <i class="bi bi-plus-lg"></i> Nueva Entrada
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
                            <th>Descripcion</th>
                            <th>Producto</th>
                            <th>Usuario</th>
                            <th>Cantidad</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            @foreach($estradas as $entrada)
                                <td>{{ $entrada->id }}</td>
                                <td>{{ $entrada->fecha->format('d/m/Y') }}</td>
                                <td>{{ $entrada->descripcion }}</td>
                                <td>{{ $entrada->producto->nombre }}</td>
                                <td>{{ $entrada->user->name }}</td>
                                <td>{{ $entrada->cantidad }}</td>
                                <td>
                        
                                    <form action="{{ route('entradas.destroy', $entrada->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('¿Estás seguro de que deseas eliminar esta entrada?')">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            @endforeach
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
