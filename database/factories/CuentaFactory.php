<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CuentaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nombre_cuenta'=> $this->faker->name(),
            'codigo_cuenta'=> $this->faker->randomNumber(3)
        ];
    }
}
