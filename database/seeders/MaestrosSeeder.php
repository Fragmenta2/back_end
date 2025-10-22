<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Maestro;

class MaestrosSeeder extends Seeder
{
    public function run()
    {
        // Crear 10 maestros de ejemplo
        Maestro::factory()->count(10)->create();
    }
}
