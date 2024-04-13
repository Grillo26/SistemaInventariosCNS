<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Subcategoria;
use App\Models\Categoria;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;




class SubcategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('subcategorias')->insert([
            'nombre_subcategoria' => 'Comprimido',
            'categoria_idCategoria' => 1,
        ]);

        DB::table('subcategorias')->insert([
            'nombre_subcategoria' => 'Cápsula',
            'categoria_idCategoria' => 1,
        ]);

        DB::table('subcategorias')->insert([
            'nombre_subcategoria' => 'Jarabe',
            'categoria_idCategoria' => 1,
        ]);

        DB::table('subcategorias')->insert([
            'nombre_subcategoria' => 'Crema',
            'categoria_idCategoria' => 1,
        ]);

        DB::table('subcategorias')->insert([
            'nombre_subcategoria' => 'Gel',
            'categoria_idCategoria' => 1,
        ]);

        DB::table('subcategorias')->insert([
            'nombre_subcategoria' => 'Tableta Efervescente',
            'categoria_idCategoria' => 1,
        ]);

        DB::table('subcategorias')->insert([
            'nombre_subcategoria' => 'Tableta Masticable',
            'categoria_idCategoria' => 1,
        ]);

        DB::table('subcategorias')->insert([
            'nombre_subcategoria' => 'Enema',
            'categoria_idCategoria' => 1,
        ]);

        DB::table('subcategorias')->insert([
            'nombre_subcategoria' => 'Gotas',
            'categoria_idCategoria' => 1,
        ]);


        DB::table('subcategorias')->insert([
            'nombre_subcategoria' => 'Bolígrafo',
            'categoria_idCategoria' => 2,
        ]);

        DB::table('subcategorias')->insert([
            'nombre_subcategoria' => 'Lápiz',
            'categoria_idCategoria' => 2,
        ]);

        DB::table('subcategorias')->insert([
            'nombre_subcategoria' => 'Marcador',
            'categoria_idCategoria' => 2,
        ]);

        DB::table('subcategorias')->insert([
            'nombre_subcategoria' => 'Correctore',
            'categoria_idCategoria' => 2,
        ]);

        DB::table('subcategorias')->insert([
            'nombre_subcategoria' => 'Portamina',
            'categoria_idCategoria' => 2,
        ]);

        DB::table('subcategorias')->insert([
            'nombre_subcategoria' => 'Goma de Borrar',
            'categoria_idCategoria' => 2,
        ]);

        DB::table('subcategorias')->insert([
            'nombre_subcategoria' => 'Sacapunta',
            'categoria_idCategoria' => 2,
        ]);

        DB::table('subcategorias')->insert([
            'nombre_subcategoria' => 'Archivador',
            'categoria_idCategoria' => 2,
        ]);

        DB::table('subcategorias')->insert([
            'nombre_subcategoria' => 'Clip',
            'categoria_idCategoria' => 2,
        ]);

        DB::table('subcategorias')->insert([
            'nombre_subcategoria' => 'Grapa',
            'categoria_idCategoria' => 2,
        ]);

        DB::table('subcategorias')->insert([
            'nombre_subcategoria' => 'Sobre',
            'categoria_idCategoria' => 2,
        ]);

        DB::table('subcategorias')->insert([
            'nombre_subcategoria' => 'Regla',
            'categoria_idCategoria' => 2,
        ]);

        DB::table('subcategorias')->insert([
            'nombre_subcategoria' => 'Tijera',
            'categoria_idCategoria' => 2,
        ]);

        DB::table('subcategorias')->insert([
            'nombre_subcategoria' => 'Papel Bond',
            'categoria_idCategoria' => 2,
        ]);

        /*---------------------------------- */
        DB::table('subcategorias')->insert([
            'nombre_subcategoria' => 'Escoba',
            'categoria_idCategoria' => 3,
        ]);

        DB::table('subcategorias')->insert([
            'nombre_subcategoria' => 'Trapeador',
            'categoria_idCategoria' => 3,
        ]);

        DB::table('subcategorias')->insert([
            'nombre_subcategoria' => 'Esponja',
            'categoria_idCategoria' => 3,
        ]);

        DB::table('subcategorias')->insert([
            'nombre_subcategoria' => 'Recogedor de Polvo',
            'categoria_idCategoria' => 3,
        ]);

        DB::table('subcategorias')->insert([
            'nombre_subcategoria' => 'Guante',
            'categoria_idCategoria' => 3,
        ]);

        DB::table('subcategorias')->insert([
            'nombre_subcategoria' => 'Cubeta o balde',
            'categoria_idCategoria' => 3,
        ]);

        DB::table('subcategorias')->insert([
            'nombre_subcategoria' => 'Detergente',
            'categoria_idCategoria' => 3,
        ]);

        DB::table('subcategorias')->insert([
            'nombre_subcategoria' => 'Desinfectante',
            'categoria_idCategoria' => 3,
        ]);

        DB::table('subcategorias')->insert([
            'nombre_subcategoria' => 'Plumero',
            'categoria_idCategoria' => 3,
        ]);

        DB::table('subcategorias')->insert([
            'nombre_subcategoria' => 'Bolsas para Basura',
            'categoria_idCategoria' => 3,
        ]);

        DB::table('subcategorias')->insert([
            'nombre_subcategoria' => 'Papel Higiénico',
            'categoria_idCategoria' => 3,
        ]);

        DB::table('subcategorias')->insert([
            'nombre_subcategoria' => 'Limpiavidrio',
            'categoria_idCategoria' => 3,
        ]);

        DB::table('subcategorias')->insert([
            'nombre_subcategoria' => 'Limpiadro de piso',
            'categoria_idCategoria' => 3,
        ]);

    }
}
