<?php

namespace Tests\Feature\Admin\users;

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Http\Controllers\Admin\AdminUserController;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function  testIndex_Admin_search()
    {
        User::factory()->create([
            'name' => 'Carlos enrique d ',
            'email' => 'carlosd@hotmail.com',
            'password' => bcrypt('car123456')
        ]);
        $request = new Request(['search' => 'Carlos']);
        $controller = new AdminUserController();
        $response = $controller->index($request);
        $this->assertEquals('admin.users.index', $response->name());
        $users = $response->getData()['users'];
        $this->assertTrue($users->contains(function ($user) use ($request) {
            return str_contains($user->name, $request->query('search'));
        }));
    }
}
