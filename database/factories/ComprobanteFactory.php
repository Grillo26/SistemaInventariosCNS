<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ComprobanteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'n_comprobante' => $this->faker->randomNumber(5),
            'detalle' => $this->faker->sentence(8)
        ];
    }
}
