<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Clase;

class ClasesSeeder extends Seeder
{
    public function run()
    {
        // Crear 10 clases de ejemplo
        Clase::factory()->count(10)->create();
    }
}
