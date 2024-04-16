<?php

namespace Database\Seeders;
use App\Models\User;
use App\Models\Unidad;
use App\Models\Cuenta;
use App\Models\Estante;
use App\Models\Grupo;
use App\Models\Mesa;
use App\Models\Pasillo;
use App\Models\Proveedor;
use App\Models\Dll;
use App\Models\Comprobante;
use App\Models\Producto;
use App\Models\Estado;
use App\Models\Categoria;
use App\Models\Subcategoria;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $user = new User();
        $user->name = 'Carlos Enrique';
        $user->lastname = 'Mamani Torrez';
        $user->username = 'grillo26';
        $user->email = 'carlsenrmt26@gmail.com';
        $user->email_verified_at = now();
        $user->password =  bcrypt('kuynva26101997');
        $user->remember_token = Str::random(10);
        $user->save();
    
        $user2 = new User();
        $user2->name = 'Alejandra';
        $user2->lastname = 'Mamani Torrez';
        $user2->username = 'ale';
        $user2->email = 'ale@gmail.com';
        $user2->email_verified_at = now();
        $user2->password =  bcrypt('kuynva26101997');
        $user2->remember_token = Str::random(10);
        $user2->save();

        $estado1 = new Estado();
        $estado1->estado = 'no respondido';
        $estado1->save();

        $estado2 = new Estado();
        $estado2->estado = 'respondido';
        $estado2->save();

        $categoria1 = new Categoria();
        $categoria1->nombre_categoria ='Medicamento';
        $categoria1->save();

        $categoria2 = new Categoria();
        $categoria2->nombre_categoria ='Material de Escritorio';
        $categoria2->save();

        $categoria3 = new Categoria();
        $categoria3->nombre_categoria ='Artículo de Limpieza';
        $categoria3->save();

        $this->call(RoleSeeder::class); //Agrega a la base de datos los roles
        $this->call(UserSeeder::class);
        $this->call(SubcategoriaSeeder::class);
    


        \App\Models\Unidad::factory(10)->create();
        \App\Models\Cuenta::factory(10)->create();
        \App\Models\Estante::factory(10)->create();
        \App\Models\Grupo::factory(10)->create();
        \App\Models\Mesa::factory(10)->create();
        \App\Models\Pasillo::factory(10)->create();
        \App\Models\Proveedor::factory(50)->create();
        \App\Models\Dll::factory(50)->create();
        \App\Models\Producto::factory(50)->create();

    
    }
}
