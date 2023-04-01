<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AdminTestController extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
public function test_Admin_can_access_AdminHome()
{

    // usuario con permiso de admin 

    // $user = User::find(51);

    $role1 =  Role::create(['name' => 'Admin']);
    Permission::create(['name' => 'admin.users.index'])->assignRole($role1);
    // Permission::create(['name' => 'admin.users.edit'])->assignRole($role1);
    $user = User::factory()->create()->assignRole('Admin');
    // dump($user->hasRole('Admin') == true);
    $response = $this->actingAs($user)->get('admin/home');
    $response->assertStatus(200);

    $response->assertSee('users');
}