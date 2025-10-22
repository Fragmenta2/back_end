<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Clase;

class ClaseController extends Controller
{
    public function index()
    {
        $clases = Clase::with('alumnos')->get();
        return response()->json($clases);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre_clase' => 'required',
            'id_maestro' => 'required|integer',
        ]);

        $clase = Clase::create($request->all());
        return response()->json($clase, 201);
    }

    public function show($id)
    {
        $clase = Clase::with('alumnos')->find($id);

        if (!$clase) {
            return response()->json(['message' => 'Clase no encontrada'], 404);
        }

        return response()->json($clase);
    }

    public function update(Request $request, $id)
    {
        $clase = Clase::find($id);
        if (!$clase) {
            return response()->json(['message' => 'Clase no encontrada'], 404);
        }

        $clase->update($request->all());
        return response()->json($clase);
    }

    public function destroy($id)
    {
        $clase = Clase::find($id);
        if (!$clase) {
            return response()->json(['message' => 'Clase no encontrada'], 404);
        }

        $clase->delete();
        return response()->json(['message' => 'Clase eliminada']);
    }

    public function asignarAlumnos(Request $request, $id)
    {
        $clase = Clase::find($id);
        if (!$clase) {
            return response()->json(['message' => 'Clase no encontrada'], 404);
        }

        $clase->alumnos()->sync($request->alumnos);

        return response()->json($clase->load('alumnos'));
    }
}
