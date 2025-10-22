<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Alumno;

class AlumnoSeeder extends Seeder
{
    public function run(): void
    {
        Alumno::factory()->count(10)->create(); // crea 10 alumnos
    }
}