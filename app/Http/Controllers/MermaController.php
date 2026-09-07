<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Merma;

class MermaController extends Controller
{
    public function index()
    {
        $mermas = Merma::with('producto','user')->get();
        return view('merma.index', compact('mermas'));
        
    }

    public function create()
    {
        $produtos = Producto::all();
        return view('merma.create', compact('produtos'));
    }

    public function store(Request $request)
    {
        $merma = new Merma();
        $merma->motivo = $request->input('motivo');
        $merma->producto_id = $request->input('producto_id');
        $merma->cantidad = $request->input('cantidad');
        $merma->fecha = $request->input('fecha');
        $merma->user_id = auth()->user()->id;
        $merma->save();

        $productos = Producto::find($merma->producto_id);
        $productos->stock -= $merma->cantidad;
        $productos->save();

        return redirect()->route('merma.index')->with('success', 'Merma registrada correctamente.');
    }

    public function show($id)
    {
        return view('merma.show', compact('id'));
    }

    public function edit($id)
    {
        return view('merma.edit', compact('id'));
    }

    public function update(Request $request, $id)
    {
        return redirect()->route('merma.index')->with('success', 'Merma actualizada correctamente.');
    }

    public function destroy($id)
    {
        $merma = Merma::findOrFail($id);
        $productos = Producto::find($merma->producto_id);
        $productos->stock += $merma->cantidad;
        $productos->save();
        $merma->delete();
        return redirect()->route('merma.index')->with('success', 'Merma eliminada correctamente.');
    }
}
