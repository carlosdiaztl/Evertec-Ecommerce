<?php

namespace Tests\Feature;

use App\Http\Controllers\UserController;
use App\Models\User;
use Illuminate\Http\Request;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Config;

class UserControllerIndexTest extends TestCase
{
    // este comando aplica datos temporales en el test

    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_Admin_can_access_AdminUsers()
    {

        $entornoloc1 = Config::get('database.connections.mysql');
        $connection = Config::get('env.DB_CONNECTION');
        dump($connection, $entornoloc1);

        echo ("<script>console.log('PHP db connection: " . getenv('DB_CONNECTION') . "');</script>");

        echo ("<script>console.log('PHP DB_PASSWORD: " . getenv('DB_PASSWORD') . "');</script>");

        echo ("<script>console.log('PHP DB_PORT: " . getenv('DB_PORT') . "');</script>");

        echo ("<script>console.log('PHP DB_HOST: " . getenv('DB_HOST') . "');</script>");

        echo ("<script>console.log('PHP DB_USERNAME: " . getenv('DB_USERNAME') . "');</script>");






        // usuario con permiso de admin 
        dump(1);
        dump($_ENV['env']);
        $user = User::find(51);
        $response = $this->actingAs($user)->get('/admin/users');
        $response->assertStatus(200);
        // dump($response->getContent());
        $response->assertSee('users');
    }
    public function test_User_cant_access_AdminUsers()
    {

        $user = User::create([
            'name' => 'Carlos enrique d ',
            'email' => 'carlosd@hotmail.com',
            'password' => bcrypt('car123456')
        ]);
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
