<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class UnidadFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nombre_unidad' => $this->faker->name()
        ];
    }
}
