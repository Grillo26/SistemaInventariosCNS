<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class EstanteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'n_estante' => $this->faker->randomNumber(5),
            'descripcion' => $this->faker->sentence(8)
        ];
    }
}
