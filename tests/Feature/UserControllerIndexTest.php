<?php

namespace Tests\Feature;

use App\Http\Controllers\UserController;
use App\Models\User;
use Illuminate\Http\Request;
use Tests\TestCase;

class UserControllerIndexTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_Admin_can_access_AdminUsers()
    {


        // usuario con permiso de admin 
        $user = User::find(51);
        $response = $this->actingAs($user)->get('/admin/users');
        $response->assertStatus(200);
        // dump($response->getContent());
        $response->assertSee('users');
    }
    public function test_User_cant_access_AdminUsers()
    {

        $user = User::find(12);
        $response = $this->actingAs($user)->get('/admin/users');
        $response->assertStatus(403);
        // dump($response->getContent());
        $response->assertSee('This action is unauthorized.');
    }
    public function  testIndex_Admin_search()
    {
        User::make([
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
