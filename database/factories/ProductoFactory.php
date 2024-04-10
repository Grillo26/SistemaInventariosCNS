<?php

namespace Database\Factories;
use App\Models\Grupo;
use App\Models\Cuenta;
use App\Models\Unidad;
use App\Models\Mesa;
use App\Models\Pasillo;
use App\Models\Estante;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'codigo_producto'=> $this->faker->randomNumber(4),
            'nombre_producto'=> $this->faker->name(),
            'unidad_idUnidad' => function () {
            return Unidad::inRandomOrder()->first()->id; // Obtiene una unidad aleatoria de la tabla de unidades
        },
        'grupo_idGrupo' => function () {
            return Grupo::inRandomOrder()->first()->id; // Obtiene un grupo aleatorio de la tabla de grupos
        },
        'cuenta_idCuenta' => function () {
            return Cuenta::inRandomOrder()->first()->id; // Obtiene una cuenta aleatoria de la tabla de cuentas
        },
        'pasillo_idPasillo' => function () {
            return Pasillo::inRandomOrder()->first()->id; // Obtiene una cuenta aleatoria de la tabla de cuentas
        },
        'estante_idEstante' => function () {
            return Estante::inRandomOrder()->first()->id; // Obtiene una cuenta aleatoria de la tabla de cuentas
        },
        'mesa_idMesa' => function () {
            return Mesa::inRandomOrder()->first()->id; // Obtiene una cuenta aleatoria de la tabla de cuentas
        },
            

        ];
    }
}
