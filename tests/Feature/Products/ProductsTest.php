<?php

namespace Tests\Feature\Products;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductsTest extends TestCase
{
    use RefreshDatabase; // Utilizar el trait RefreshDatabase para mantener la base de datos limpia


    public function test_user_can_view_all_avaliables_products(): void
    {
        Category::factory()->count(3)->create();

        $availableProducts = Product::factory()->count(5)->create([
            'status' => 'available',
        ]);
        $response = $this->get('/');
        $response->assertStatus(200);

        // verificar que los productos disponibles  aparecen en la vista
        foreach ($availableProducts as $availableProduct) {
            $response->assertSee($availableProduct->title);
            $response->assertSee($availableProduct->image);
            $response->assertSee($availableProduct->category->name);
            $response->assertSee($availableProduct->price);
        }
    }
    public function test_user_cant_view_all_unavaliables_products(): void
    {
        Category::factory()->count(3)->create();

        $unavailableProducts = Product::factory()->count(5)->create([
            'status' => 'unavailable',
        ]);
        $response = $this->get('/');
        $response->assertStatus(200);

        // verificar que los productos no disponibles no aparezcan en la vista
        foreach ($unavailableProducts as $unavailableProduct) {
            $response->assertDontSee($unavailableProduct->title);
        }
    }
}
