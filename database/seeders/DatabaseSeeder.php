<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Storage::deleteDirectory('public/images');
        Storage::makeDirectory('public/images');
        User::factory(22)->create();
        //funcion de usuarios sin corrreo verificadp
        // \App\Models\User::factory(50)->unverified()->create();


        // seeder de los roles 
        $this->call(RoleSeeder::class);


        // usuario de prueba 

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'diaz-alzate@hotmail.com',
            'password' => bcrypt('car123456')

        ])->assignRole('Admin');

        User::factory()->create([
            'name' => 'Test User1',
            'email' => 'diaz-alzate1@hotmail.com',
            'password' => bcrypt('car123456')
        ]);
    }
}
