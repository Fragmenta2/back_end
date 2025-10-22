<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Clase;
use App\Models\Maestro;

class ClaseFactory extends Factory
{
    protected $model = Clase::class;

    public function definition()
    {
        $maestro_ids = Maestro::pluck('id')->toArray();

        return [
            'nombre_clase' => $this->faker->words(2, true),
            'id_maestro' => $this->faker->randomElement($maestro_ids),
        ];
    }
}
