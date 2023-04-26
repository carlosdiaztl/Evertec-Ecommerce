<?php

namespace Tests\Feature\Admin;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AdminControllerTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_Admin_can_access_AdminHome()
    {
        $role1 =  Role::create(['name' => 'Admin']);
        Permission::create(['name' => 'admin.users.index'])->assignRole($role1);
        Permission::create(['name' => 'admin.users.edit'])->assignRole($role1);
        $user = User::factory()->create()->assignRole('Admin');
        $response = $this->actingAs($user)->get('/admin/home');
        $response->assertStatus(200);
        $response->assertSee('users');
    }
    public function test_User_cant_access_AdminHome()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get('/admin/home');
        $response->assertStatus(403);
        $response->assertSee('This action is unauthorized.');
    }
    public function test_admin_edit_userpassword()
    {
        $role1 =  Role::create(['name' => 'Admin']);
        Permission::create(['name' => 'admin.users.index'])->assignRole($role1);
        Permission::create(['name' => 'admin.users.edit'])->assignRole($role1);
        $user = User::factory()->create()->assignRole('Admin');
        $user2 = User::factory()->create();
        $response = $this->actingAs($user)->get(route('admin.users.edit', $user));
        $response->assertStatus(200);
        $response->assertSee('users');
        $response = $this->actingAs($user)->get(route('admin.users.edit', $user2));
        $response->assertStatus(200);
        $response->assertViewIs('admin.users.edit');
    }
}
