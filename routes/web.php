<?php

use App\Models\Entrada;
use App\Models\Asignacion;
use App\Models\Merma;
use App\Models\Producto;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\EntradaController;
use App\Http\Controllers\AsignacionController;
use App\Http\Controllers\MermaController;
use App\Http\Controllers\InformeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', function () {
    $totalEntradas = Entrada::count();
    $totalAsignaciones = Asignacion::count();
    $totalMermas = Merma::count();

    $productos = Producto::all();

    $entradasPorProducto = Entrada::select('producto_id', DB::raw('SUM(cantidad) as total'))
        ->groupBy('producto_id')
        ->pluck('total', 'producto_id');

    $mermasPorProducto = Merma::select('producto_id', DB::raw('SUM(cantidad) as total'))
        ->groupBy('producto_id')
        ->pluck('total', 'producto_id');

    $nombresProductos = $productos->pluck('nombre')->toJson();
    $dataEntradas = $productos->map(fn($p) => $entradasPorProducto[$p->id] ?? 0)->toJson();
    $dataMermas = $productos->map(fn($p) => $mermasPorProducto[$p->id] ?? 0)->toJson();

    return view('dashboard', compact(
        'totalEntradas', 'totalAsignaciones', 'totalMermas',
        'nombresProductos', 'dataEntradas', 'dataMermas'
    ));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::resource('entradas', EntradaController::class);
    Route::resource('asignaciones', AsignacionController::class);
    Route::resource('merma', MermaController::class);
    Route::resource('informes', InformeController::class);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
