<x-app-layout>
    <x-slot name="header">
        <h2 class="fs-4 fw-bold text-dark">Informes</h2>
    </x-slot>

    <div class="card card-dashboard">
        <div class="card-header bg-white">Buscar registros</div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <form method="GET" action="{{ route('informes.index') }}" class="row g-3 mb-4">
                <div class="col-md-3">
                    <label class="form-label">Tipo</label>
                    <select class="form-select" name="tipo">
                        <option value="">-- Todos --</option>
                        <option value="entrada" {{ ($filters['tipo'] ?? '') == 'entrada' ? 'selected' : '' }}>Entrada</option>
                        <option value="asignacion" {{ ($filters['tipo'] ?? '') == 'asignacion' ? 'selected' : '' }}>Asignacion</option>
                        <option value="merma" {{ ($filters['tipo'] ?? '') == 'merma' ? 'selected' : '' }}>Merma</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Trabajador</label>
                    <select class="form-select" name="user_id">
                        <option value="">-- Todos --</option>
                        @foreach($usuarios as $usuario)
                            <option value="{{ $usuario->id }}" {{ ($filters['user_id'] ?? '') == $usuario->id ? 'selected' : '' }}>
                                {{ $usuario->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Producto</label>
                    <select class="form-select" name="producto_id">
                        <option value="">-- Todos --</option>
                        @foreach($productos as $producto)
                            <option value="{{ $producto->id }}" {{ ($filters['producto_id'] ?? '') == $producto->id ? 'selected' : '' }}>
                                {{ $producto->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3 d-flex align-items-end">
                    <button type="submit" class="btn btn-dark">
                        <i class="bi bi-search"></i> Buscar
                    </button>
                </div>
            </form>

            @if($resultados->count() > 0)
                <div class="d-flex justify-content-end mb-3">
                    <button type="button" class="btn btn-success btn-sm" onclick="exportarExcel()">
                        <i class="bi bi-file-earmark-excel"></i> Excel
                    </button>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover" id="tablaInformes">
                        <thead class="table-light">
                            <tr>
                                <th>Tipo</th>
                                <th>Fecha</th>
                                <th>Producto</th>
                                <th>Usuario</th>
                                <th>Cantidad</th>
                                <th>Descripcion</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($resultados as $registro)
                                <tr>
                                    <td>
                                        @if($registro['tipo'] == 'Entrada')
                                            <span class="badge bg-primary">Entrada</span>
                                        @elseif($registro['tipo'] == 'Asignacion')
                                            <span class="badge bg-info">Asignacion</span>
                                        @else
                                            <span class="badge bg-danger">Merma</span>
                                        @endif
                                    </td>
                                    <td>{{ $registro['fecha']->format('d/m/Y') }}</td>
                                    <td>{{ $registro['producto'] }}</td>
                                    <td>{{ $registro['usuario'] }}</td>
                                    <td>{{ $registro['cantidad'] }}</td>
                                    <td>{{ $registro['descripcion'] }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @elseif(count($filters) && array_filter($filters))
                <div class="text-center text-muted py-4">
                    No se encontraron registros con los filtros seleccionados
                </div>
            @endif
        </div>
    </div>

    <script>
        function exportarExcel() {
            const tabla = document.getElementById('tablaInformes');
            let csv = [];

            const filas = tabla.querySelectorAll('tr');
            filas.forEach(function(fila) {
                const columnas = fila.querySelectorAll('th, td');
                const rowData = [];
                columnas.forEach(function(col) {
                    let texto = col.innerText.replace(/"/g, '""').trim();
                    rowData.push('"' + texto + '"');
                });
                csv.push(rowData.join(';'));
            });

            const blob = new Blob([csv.join('\n')], { type: 'text/csv;charset=utf-8;' });
            const link = document.createElement('a');
            link.href = URL.createObjectURL(blob);
            link.download = 'informes.csv';
            link.click();
        }
    </script>
</x-app-layout>
