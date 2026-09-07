<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Entrada;
use App\Models\Producto;

class EntradaController extends Controller
{
    public function index()
    {
        $estradas = Entrada::with('producto','user')->get();
        return view('entradas.index' , compact('estradas'));
    }

    public function create()
    {
        $productos = Producto::all();
        return view('entradas.create', compact('productos'));
    }

    public function store(Request $request)
    {
 
        $entrada = new Entrada();
        $entrada->descripcion = $request->input('descripcion');
        $entrada->producto_id = $request->input('producto_id');
        $entrada->cantidad = $request->input('cantidad');
        $entrada->fecha = $request->input('fecha');
        $entrada->user_id = auth()->user()->id;
        $entrada->save();

        $productos = Producto::find($entrada->producto_id);
        $productos->stock += $entrada->cantidad;
        $productos->save();


        return redirect()->route('entradas.index')->with('success', 'Entrada registrada correctamente.');
    }

    public function show($id)
    {
        return view('entradas.show', compact('id'));
    }

    public function edit($id)
    {
        return view('entradas.edit', compact('id'));
    }

    public function update(Request $request, $id)
    {
        return redirect()->route('entradas.index')->with('success', 'Entrada actualizada correctamente.');
    }

    public function destroy($id)
    {
        $entrada = Entrada::findOrFail($id);
        $productos = Producto::find($entrada->producto_id);
        $productos->stock -= $entrada->cantidad;
        $productos->save();
        $entrada->delete();
        return redirect()->route('entradas.index')->with('success', 'Entrada eliminada correctamente.');
    }
}
