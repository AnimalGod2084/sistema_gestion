<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Producto;
use App\Models\Entrada;
use App\Models\Asignacion;
use App\Models\Merma;

class InformeController extends Controller
{
    public function index(Request $request)
    {
        $usuarios = User::all();
        $productos = Producto::all();
        $resultados = collect();
        $filters = $request->only(['user_id', 'producto_id', 'tipo']);
        $tipo = $request->input('tipo');

        if ($request->filled('user_id') || $request->filled('producto_id') || $tipo) {
            $resultados = collect();

            if (!$tipo || $tipo == 'entrada') {
                $resultados = $resultados->concat($this->buscarEntradas($request));
            }
            if (!$tipo || $tipo == 'asignacion') {
                $resultados = $resultados->concat($this->buscarAsignaciones($request));
            }
            if (!$tipo || $tipo == 'merma') {
                $resultados = $resultados->concat($this->buscarMermas($request));
            }
        }

        return view('informes.index', compact('usuarios', 'productos', 'resultados', 'filters'));
    }

    private function buscarEntradas(Request $request)
    {
        $query = Entrada::with(['producto', 'user']);

        if ($request->filled('user_id')) {
            $query->where('user_id', $request->user_id);
        }
        if ($request->filled('producto_id')) {
            $query->where('producto_id', $request->producto_id);
        }

        return $query->get()->map(function ($item) {
            return [
                'tipo' => 'Entrada',
                'fecha' => $item->fecha,
                'producto' => $item->producto->nombre ?? '',
                'usuario' => $item->user->name ?? '',
                'cantidad' => $item->cantidad,
                'descripcion' => $item->descripcion,
            ];
        });
    }

    private function buscarAsignaciones(Request $request)
    {
        $query = Asignacion::with(['user']);

        if ($request->filled('user_id')) {
            $query->where('user_id', $request->user_id);
        }

        return $query->get()->map(function ($item) {
            return [
                'tipo' => 'Asignacion',
                'fecha' => $item->fecha,
                'producto' => $item->tarea,
                'usuario' => $item->user->name ?? '',
                'cantidad' => '-',
                'descripcion' => $item->descripcion,
            ];
        });
    }

    private function buscarMermas(Request $request)
    {
        $query = Merma::with(['producto', 'user']);

        if ($request->filled('user_id')) {
            $query->where('user_id', $request->user_id);
        }
        if ($request->filled('producto_id')) {
            $query->where('producto_id', $request->producto_id);
        }

        return $query->get()->map(function ($item) {
            return [
                'tipo' => 'Merma',
                'fecha' => $item->fecha,
                'producto' => $item->producto->nombre ?? '',
                'usuario' => $item->user->name ?? '',
                'cantidad' => $item->cantidad,
                'descripcion' => $item->motivo,
            ];
        });
    }

    public function create()
    {
        return view('informes.create');
    }

    public function store(Request $request)
    {
        return redirect()->route('informes.index')->with('success', 'Informe generado correctamente.');
    }

    public function show($id)
    {
        return view('informes.show', compact('id'));
    }
}
