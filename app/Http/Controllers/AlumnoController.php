<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alumno;

class AlumnoController extends Controller
{
    public function index()
    {
        $alumnos = Alumno::all();
        return response()->json($alumnos);
    }

    public function store(Request $request)
    {
        $request->validate([
            'codigo' => 'required|unique:alumnos',
            'nombre' => 'required',
            'correo' => 'required|email|unique:alumnos',
            'fecha_nacimiento' => 'required|date',
            'sexo' => 'required|in:M,F',
            'carrera' => 'required',
        ]);

        $alumno = Alumno::create($request->all());

        return response()->json($alumno, 201);
    }

    public function show($id)
    {
        $alumno = Alumno::find($id);
        if (!$alumno) {
            return response()->json(['message' => 'Alumno no encontrado'], 404);
        }
        return response()->json($alumno);
    }

    public function update(Request $request, $id)
    {
        $alumno = Alumno::find($id);
        if (!$alumno) {
            return response()->json(['message' => 'Alumno no encontrado'], 404);
        }

        $request->validate([
            'codigo' => 'required|unique:alumnos,codigo,' . $id, 
            'nombre' => 'required',
            'correo' => 'required|email|unique:alumnos,correo,' . $id, 
            'fecha_nacimiento' => 'required|date',
            'sexo' => 'required|in:M,F',
            'carrera' => 'required',
        ]);

        $alumno->update($request->all());
        return response()->json($alumno);
    }
    public function destroy($id)
    {
        $alumno = Alumno::find($id);
        if (!$alumno) {
            return response()->json(['message' => 'Alumno no encontrado'], 404);
        }

        $alumno->delete();
        return response()->json(['message' => 'Alumno eliminado']);
    }
}
