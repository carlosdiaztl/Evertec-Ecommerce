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
    public function test_user_cant_view_unavaliables_products(): void
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
    public function test_user_can_search_products(): void
    {
        Category::factory()->count(3)->create();
        $availableProducts = Product::factory()->count(3)->create([
            'status' => 'available',
        ]);
        $unavailableProducts = Product::factory()->count(3)->create([
            'status' => 'unavailable',
        ]);

        // Hacer la petición con los parámetros de búsqueda
        $response = $this->get(route('welcome', [
            'search' => $availableProducts->first()->title, // Usar el título del primer producto disponible como criterio de búsqueda

        ]));

        // Verificar que se carguen correctamente los productos y la categoría
        $response->assertSuccessful();
        $response->assertViewHas('products');
        $response->assertViewHas('categories');

        // Verificar que se muestren los productos con los criterios de búsqueda
        $response->assertSee($availableProducts->first()->title);
        $response->assertSee($availableProducts->first()->image);
        $response->assertSee($availableProducts->first()->price);
        $response = $this->get(route('welcome', [
            'search' => $unavailableProducts->first()->title, // Usar el título del primer producto no disponible como criterio de búsqueda

        ]));

        // Verificar que se carguen correctamente los productos y la categoría
        $response->assertSuccessful();
        $response->assertViewHas('products');
        $response->assertViewHas('categories');
        $response->assertDontSee($unavailableProducts->first()->title);
        $response->assertDontSee($unavailableProducts->first()->image);
        $response->assertDontSee($unavailableProducts->first()->price);
    }
}
