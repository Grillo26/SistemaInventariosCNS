<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class GrupoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nombre_grupo'=> $this->faker->name(),
            'grupo'=> $this->faker->name(),
            'cuenta_a'=> $this->faker->randomNumber(4),
            'partida_a'=> $this->faker->randomNumber(3)

        ];
    }
}
