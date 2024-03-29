<?php

namespace Tests\Feature\Admin\Users;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Http\Controllers\Admin\AdminUserController;
use Maatwebsite\Excel\Facades\Excel;

class UsersControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    use RefreshDatabase;

    public function testIndex_Admin_search()
    {
        User::factory()->create([
            'name' => 'Carlos enrique d ',
            'email' => 'carlosd@hotmail.com',
            'password' => bcrypt('car123456'),
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

    public function test_admin_edit_userpassword()
    {
        $role1 = Role::create(['name' => 'Admin']);
        Permission::create(['name' => 'admin.users.index'])->assignRole($role1);
        Permission::create(['name' => 'admin.users.edit'])->assignRole($role1);
        $user = User::factory()->create()->assignRole('Admin');
        $user2 = User::factory()->create();
        $response = $this->actingAs($user)->get(route('admin.users.edit', $user));
        $response->assertOk();
        $response->assertSee('users');
        $response = $this->actingAs($user)->get(route('admin.users.edit', $user2));
        $response->assertOk();
        $response->assertViewIs('admin.users.edit');
    }
    public function test_export_users_excel(): void
    { 
        $role1 = Role::create(['name' => 'Admin']);
        Permission::create(['name' => 'admin.users.index'])->assignRole($role1);
        Permission::create(['name' => 'admin.users.edit'])->assignRole($role1);
        $user = User::factory()->create()->assignRole('Admin');
        Excel::fake();
        $response = $this->actingAs($user)->get(route('admin.users-excel-export'));
        $response->assertOk();
    }
 
}
