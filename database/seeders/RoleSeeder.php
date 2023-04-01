<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // roles
        $role1 =  Role::create(['name' => 'Admin']);
        $role2 = Role::create(['name' => 'User']);
        $role3 = Role::create(['name' => 'SuperAdmin']);
        // Aminstracion de usuarios 
        Permission::create(['name' => 'admin.users.index'])->assignRole($role1);
        Permission::create(['name' => 'admin.users.edit'])->assignRole($role1);
        Permission::create(['name' => 'admin.users.update'])->assignRole($role1);
        Permission::create(['name' => 'admin.users.create'])->assignRole($role1);
        Permission::create(['name' => 'admin.users.store'])->assignRole($role1);
        // Administracion de productos 
        Permission::create(['name' => 'admin.products.index'])->assignRole($role1);
        Permission::create(['name' => 'admin.products.create'])->assignRole($role1);
        Permission::create(['name' => 'admin.products.edit'])->assignRole($role1);
        Permission::create(['name' => 'admin.products.destroy'])->assignRole($role1);


        //
    }
}
