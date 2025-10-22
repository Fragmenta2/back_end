<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Maestro;

class MaestroController extends Controller
{
    public function index()
    {
        $maestros = Maestro::all();
        return response()->json($maestros);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'correo' => 'required|email|unique:maestros',
            'contrasena' => 'required|min:6',
        ]);

        $maestro = Maestro::create($request->all());
        return response()->json($maestro, 201);
    }

    public function show($id)
    {
        $maestro = Maestro::find($id);
        if (!$maestro) {
            return response()->json(['message' => 'Maestro no encontrado'], 404);
        }
        return response()->json($maestro);
    }

    public function update(Request $request, $id)
    {
        $maestro = Maestro::find($id);
        if (!$maestro) {
            return response()->json(['message' => 'Maestro no encontrado'], 404);
        }

        $maestro->update($request->all());
        return response()->json($maestro);
    }

    public function destroy($id)
    {
        $maestro = Maestro::find($id);
        if (!$maestro) {
            return response()->json(['message' => 'Maestro no encontrado'], 404);
        }

        $maestro->delete();
        return response()->json(['message' => 'Maestro eliminado']);
    }
}
