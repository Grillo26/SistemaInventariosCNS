<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProveedorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nombre_proveedor'=> $this->faker->name(),
            'n_telefono'=> $this->faker->phoneNumber(),
            'email' => $this->faker->email()
        ];
    }
}
