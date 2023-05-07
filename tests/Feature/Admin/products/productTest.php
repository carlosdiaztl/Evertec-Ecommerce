<?php

namespace Tests\Feature\Admin\products;

use Tests\TestCase;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Foundation\Testing\RefreshDatabase;

class productTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    use RefreshDatabase;

    public function test_route_products_only_admin(): void
    {
        $role1 = Role::create(['name' => 'Admin']);
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
