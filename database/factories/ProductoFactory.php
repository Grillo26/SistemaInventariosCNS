<?php

namespace Database\Factories;
use App\Models\Grupo;
use App\Models\Cuenta;
use App\Models\Unidad;
use App\Models\Mesa;
use App\Models\Pasillo;
use App\Models\Estante;
use App\Models\Categoria;
use App\Models\Subcategoria;
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
        $categoriaId = Categoria::inRandomOrder()->first()->id; // Obtiene un ID de categoría aleatorio
        $subcategoriaId = null;
        // Verificar la categoría y establecer la subcategoría en consecuencia
        if ($categoriaId == 1) {
            // Si la categoría es 1, elige un ID de subcategoría entre 1 y 9
            $subcategoriaId = rand(1, 9);
        } 
        if ($categoriaId == 2) {
            // Si la categoría es 1, elige un ID de subcategoría entre 1 y 9
            $subcategoriaId = rand(10, 23);
        }
        if ($categoriaId == 3) {
            // Si la categoría es 1, elige un ID de subcategoría entre 1 y 9
            $subcategoriaId = rand(24, 36);
        }
        
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

        'categoria_idCategoria' => $categoriaId,
        'subcategoria_idSubcategoria' => $subcategoriaId,
            

        ];
    }
}
