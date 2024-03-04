<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class MesaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'n_mesa'=> $this->faker->randomNumber(3)
        ];
    }
}
