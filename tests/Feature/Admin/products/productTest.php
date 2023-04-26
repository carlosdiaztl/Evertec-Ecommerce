<?php

namespace Tests\Feature\Admin\products;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class productTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    use RefreshDatabase;
    public function test_route_products_only_admin(): void
    {
        $role1 =  Role::create(['name' => 'Admin']);
        Permission::create(['name' => 'admin.products.index'])->assignRole($role1);
        $user = User::factory()->create()->assignRole('Admin');
        $response = $this->actingAs($user)->get('/admin/products/index');
        $response->assertStatus(200);
    }
    public function test_view_products_()
    {
    }
    public function test_route_products_users_cant_access(): void
    {

        $user = User::factory()->create();
        $response = $this->actingAs($user)->get('/admin/products/index');
        $response->assertStatus(403);
    }
}
