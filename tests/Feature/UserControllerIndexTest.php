<?php

namespace Tests\Feature;

use App\Http\Controllers\UserController;
use App\Models\User;
use Illuminate\Http\Request;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserControllerIndexTest extends TestCase
{
    // este comando aplica datos temporales en el test

    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_Admin_can_access_AdminUsers()
    {

        // usuario con permiso de admin 

        // $user = User::find(51);

        $role1 =  Role::create(['name' => 'Admin']);
        Permission::create(['name' => 'admin.users.index'])->assignRole($role1);
        Permission::create(['name' => 'admin.users.edit'])->assignRole($role1);
        $user = User::factory()->create()->assignRole('Admin');
        dump($user);
        $response = $this->actingAs($user)->get('/admin/users');
        $response->assertStatus(200);

        $response->assertSee('users');
    }
    public function test_User_cant_access_AdminUsers()
    {

        $user = User::factory()->create();
        // dump($user);
        $response = $this->actingAs($user)->get('/admin/users');
        $response->assertStatus(403);
        // dump($response->getContent());
        $response->assertSee('This action is unauthorized.');
    }
    public function  testIndex_Admin_search()
    // modificar este test para que el acceso sea a traves de la ruta y no la vista 
    {
        User::create([
            'name' => 'Carlos enrique d ',
            'email' => 'carlosd@hotmail.com',
            'password' => bcrypt('car123456')
        ]);
        // consulta de prueba con usuario creado 
        $request = new Request(['search' => 'Carlos']);
        $controller = new UserController();
        $response = $controller->index($request);


        // la ruta response es igual a la ruta que llamamos 
        $this->assertEquals('admin.users.index', $response->name());

        // dump($response);


        $users = $response->getData()['users'];
        // dd($users->first());
        // dd($users);

        //busqueda
        // dump($request->query('search'));


        //se busca si en el array de busquedas hay un usuario con el nombre que se busco 
        $this->assertTrue($users->contains(function ($user) use ($request) {
            return str_contains($user->name, $request->query('search'));
        }));
    }
}
