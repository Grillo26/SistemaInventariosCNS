<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Role; //imprtando modelo rol
use Spatie\Permission\Models\Permission;


class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role1= Role::create(['name' => 'Admin']);
        $role2= Role::create(['name' => 'Almacen']);
        $role3= Role::create(['name' => 'User']);

        Permission::create(['name' => 'dashboard']);

        //De preferencia en nombre que vaya la ruta , con synRoles asignamos los permisos a los roles
        Permission::create(['name' => 'user'])->syncRoles([$role1,$role2]);
        Permission::create(['name' => 'user.new'])->syncRoles([$role1,$role2]);;
        Permission::create(['name' => 'user.edit'])->syncRoles([$role1,$role2]);;

    }
}
