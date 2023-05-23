<?php

namespace Database\Seeders;

use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Seeder;
use DB;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role1 = Role::create(['name'=>'Admin']);
        $role2 = Role::create(['name'=>'Usuario']);

        
        //Usuario
        Permission::create(['name'=>'User.ver'])->assignRole($role1);
        Permission::create(['name'=>'User.crear'])->assignRole($role1);
        Permission::create(['name'=>'User.editar'])->assignRole($role1);
        Permission::create(['name'=>'User.eliminar'])->assignRole($role1);


        //Actor
        Permission::create(['name'=>'Actor.ver'])->syncRoles([$role1,$role2]);
        Permission::create(['name'=>'Actor.crear'])->syncRoles([$role1,$role2]);
        Permission::create(['name'=>'Actor.editar'])->syncRoles([$role1,$role2]);
        Permission::create(['name'=>'Actor.eliminar'])->syncRoles([$role1,$role2]);

        //Pelicula
        Permission::create(['name'=>'Pelicula.ver'])->syncRoles([$role1,$role2]);
        Permission::create(['name'=>'Pelicula.crear'])->syncRoles([$role1,$role2]);
        Permission::create(['name'=>'Pelicula.editar'])->syncRoles([$role1,$role2]);
        Permission::create(['name'=>'Pelicula.eliminar'])->syncRoles([$role1,$role2]);

        
    }
}
