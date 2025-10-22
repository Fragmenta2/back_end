<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Maestro;
use Illuminate\Support\Str;

class MaestroFactory extends Factory
{
    protected $model = Maestro::class;

    public function definition()
    {
        return [
            'nombre' => $this->faker->name(),
            'correo' => $this->faker->unique()->safeEmail(),
            'contrasena' => bcrypt('123456'), 
        ];
    }
}
