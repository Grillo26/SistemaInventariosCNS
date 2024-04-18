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
    $proveedores = [
        'Droguería INTI S.R.L.',
        'Droguería Cosmeticos y Medicamentos La Salud S.R.L.',
        'Laboratorio Específico Rollins S.A.',
        'Farmacéutica Bolivia S.R.L.',
        'Laboratorios Gramón-Bago de Bolivia S.A.',
        'Distribuidora de Productos Farmacéuticos S.R.L. (Diprofa)',
        'Cofiabol S.R.L.',
        'Laboratorio Industrial Farmacéutico (LIFAR) S.A.',
        'Droguería Los Andes',
        'Laboratorio Terbol'
    ];

    return [
        'nombre_proveedor' => $this->faker->unique()->randomElement($proveedores),
        'n_telefono' => $this->faker->phoneNumber(),
        'email' => $this->faker->email()
    ];
    }
}
