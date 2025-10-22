<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class AlumnoFactory extends Factory
{
    public function definition(): array
    {
        return [
            'codigo' => strtoupper($this->faker->bothify('ALU###')), // Ejemplo: ALU123
            'nombre' => $this->faker->name(),
            'correo' => $this->faker->unique()->safeEmail(),
            'fecha_nacimiento' => $this->faker->date('Y-m-d', '2005-12-31'),
            'sexo' => $this->faker->randomElement(['M', 'F']),
            'carrera' => $this->faker->randomElement([
                'Ingeniería en Sistemas',
                'Administración',
                'Diseño Gráfico',
                'Arquitectura',
                'Psicología',
            ]),
        ];
    }
}
