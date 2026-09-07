<x-app-layout>
    <x-slot name="header">
        <h2 class="fs-4 fw-bold text-dark">Dashboard</h2>
    </x-slot>

    <div class="row g-4 mb-4">
        <div class="col-md-4">
            <div class="card card-dashboard text-center p-3">
                <div class="card-body">
                    <i class="bi bi-box-arrow-in-right display-6 text-dark"></i>
                    <h3 class="mt-2 mb-0">{{ $totalEntradas }}</h3>
                    <p class="text-muted mb-0">Entradas</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-dashboard text-center p-3">
                <div class="card-body">
                    <i class="bi bi-people display-6 text-dark"></i>
                    <h3 class="mt-2 mb-0">{{ $totalAsignaciones }}</h3>
                    <p class="text-muted mb-0">Asignaciones</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-dashboard text-center p-3">
                <div class="card-body">
                    <i class="bi bi-trash display-6 text-dark"></i>
                    <h3 class="mt-2 mb-0">{{ $totalMermas }}</h3>
                    <p class="text-muted mb-0">Mermas</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-md-8">
            <div class="card card-dashboard">
                <div class="card-header bg-white">
                    <i class="bi bi-bar-chart"></i> Cantidad por Producto
                </div>
                <div class="card-body">
                    <canvas id="chartProductos" height="300"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-dashboard">
                <div class="card-header bg-white">
                    <i class="bi bi-pie-chart"></i> Distribucion General
                </div>
                <div class="card-body">
                    <canvas id="chartDistribucion" height="300"></canvas>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.7/dist/chart.umd.min.js"></script>
    <script>
        const nombresProductos = {!! $nombresProductos !!};
        const dataEntradas = {!! $dataEntradas !!};
        const dataMermas = {!! $dataMermas !!};

        new Chart(document.getElementById('chartProductos'), {
            type: 'bar',
            data: {
                labels: nombresProductos,
                datasets: [
                    {
                        label: 'Entradas',
                        data: dataEntradas,
                        backgroundColor: 'rgba(13, 110, 253, 0.8)',
                        borderColor: 'rgba(13, 110, 253, 1)',
                        borderWidth: 1
                    },
                    {
                        label: 'Mermas',
                        data: dataMermas,
                        backgroundColor: 'rgba(220, 53, 69, 0.8)',
                        borderColor: 'rgba(220, 53, 69, 1)',
                        borderWidth: 1
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { position: 'top' }
                },
                scales: {
                    y: { beginAtZero: true }
                }
            }
        });

        new Chart(document.getElementById('chartDistribucion'), {
            type: 'doughnut',
            data: {
                labels: ['Entradas', 'Asignaciones', 'Mermas'],
                datasets: [{
                    data: [{{ $totalEntradas }}, {{ $totalAsignaciones }}, {{ $totalMermas }}],
                    backgroundColor: [
                        'rgba(13, 110, 253, 0.8)',
                        'rgba(13, 202, 240, 0.8)',
                        'rgba(220, 53, 69, 0.8)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { position: 'bottom' }
                }
            }
        });
    </script>
</x-app-layout>
