<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Alumno;
use App\Models\Clase;

class AlumnoClaseSeeder extends Seeder
{
    public function run()
    {
        $alumnos = Alumno::all();
        $clases = Clase::all();

        foreach ($clases as $clase) {
            // Selecciona entre 3 y 6 alumnos aleatorios para cada clase
            $alumnosAleatorios = $alumnos->random(rand(3, 6))->pluck('id')->toArray();

            // Asigna los alumnos a la clase
            $clase->alumnos()->sync($alumnosAleatorios);
        }
    }
}
