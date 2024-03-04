<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class BajaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'fecha_baja'=> $this->faker->date(),
            'hora_baja' => $this->faker->time($format = 'H:i:s'),
            'cantidadb'=> $this->faker->randomNumber(4),
            'estadob'=> $this->faker->randomElement(['S', 'N'])
        ];
    }
}
