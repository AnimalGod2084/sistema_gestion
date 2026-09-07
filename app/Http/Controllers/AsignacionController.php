<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Asignacion;

class AsignacionController extends Controller
{
    public function index()
    {
        $asignaciones = Asignacion::with('user')->get();
        return view('asignaciones.index', compact('asignaciones'));
    }

    public function create()
    {
        $usuarios = User::all();
        return view('asignaciones.create', compact('usuarios'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'fecha' => 'required|date',
            'tarea' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
        ]);

        Asignacion::create([
            'user_id' => $request->user_id,
            'fecha' => $request->fecha,
            'tarea' => $request->tarea,
            'descripcion' => $request->descripcion,
            'estado' => 'pendiente',
        ]);

        return redirect()->route('asignaciones.index')->with('success', 'Asignacion registrada correctamente.');
    }

    public function show($id)
    {
        $asignacion = Asignacion::with('user')->findOrFail($id);
        return view('asignaciones.show', compact('asignacion'));
    }

    public function edit($id)
    {
        $asignacion = Asignacion::findOrFail($id);
        $usuarios = User::all();
        return view('asignaciones.edit', compact('asignacion', 'usuarios'));
    }

    public function update(Request $request, $id)
    {
        $asignacion = Asignacion::findOrFail($id);

        $request->validate([
            'user_id' => 'required|exists:users,id',
            'fecha' => 'required|date',
            'tarea' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'estado' => 'required|in:pendiente,completada,cancelada',
        ]);

        $asignacion->update([
            'user_id' => $request->user_id,
            'fecha' => $request->fecha,
            'tarea' => $request->tarea,
            'descripcion' => $request->descripcion,
            'estado' => $request->estado,
        ]);

        return redirect()->route('asignaciones.index')->with('success', 'Asignacion actualizada correctamente.');
    }

    public function destroy($id)
    {
        $asignacion = Asignacion::findOrFail($id);
        $asignacion->delete();

        return redirect()->route('asignaciones.index')->with('success', 'Asignacion eliminada correctamente.');
    }
}
