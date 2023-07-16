<?php

namespace Tests\Feature\Admin\Products;

use App\Exports\ProductExport;
use App\Models\Category;
use App\Models\Product;
use Tests\TestCase;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\File;
use Illuminate\Http\UploadedFile;
use Maatwebsite\Excel\Facades\Excel;
use stdClass;

class ProductTest extends TestCase
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
        $response = $this->actingAs($user)->get(route('admin.categories.index'));
        $response->assertOk();
    }

    public function test_route_products_users_cant_access(): void
    {

        $user = User::factory()->create();
        $response = $this->actingAs($user)->get(route('admin.categories.index'));
        $response->assertStatus(403);
    }
    public function test_view_products_()
    {
        $role1 = Role::create(['name' => 'Admin']);
        Permission::create(['name' => 'admin.products.index'])->assignRole($role1);
        $user = User::factory()->create()->assignRole('Admin');
        Category::factory()->count(2)->create();
        Product::factory()->count(1)->create();
        $response = $this->actingAs($user)->get(route('admin.products.index'));
        $products = Product::query()->paginate(10); // se obtienen los productos que se están mostrando en la vista
        foreach ($products as $product) {
            $response->assertSee($product->title);
            $response->assertSee($product->image);
            $response->assertSee($product->description);
            $response->assertSee($product->price);
            $response->assertSee($product->stock);
            $response->assertSee($product->category->name);
            $response->assertSee($product->status);
        }
    }
    public function test_export_products_excel(): void
    {
      

        $role1 = Role::create(['name' => 'Admin']);
        Permission::create(['name' => 'admin.users.index'])->assignRole($role1);
        Permission::create(['name' => 'admin.users.edit'])->assignRole($role1);
        $user = User::factory()->create()->assignRole('Admin');
        Category::factory()->count(2)->create();
        Product::factory()->count(2)->create();
        Excel::fake();
        $response = $this->actingAs($user)->get(route('admin.products-excel-export'));
        $response->assertOk();
        Excel::assertDownloaded('products.xlsx');
        $downloadedFile = $response->baseResponse->getFile()->getRealPath();
        $this->assertIsString($downloadedFile);
         
    }
    public function test_export_Import_Products(){
        Excel::fake();
        $role1 = Role::create(['name' => 'Admin']);
        Permission::create(['name' => 'admin.users.index'])->assignRole($role1);
        Permission::create(['name' => 'admin.users.edit'])->assignRole($role1);
        $user = User::factory()->create()->assignRole('Admin');
        // Crear el archivo Excel falso
       
        $file = new File('products.xlsx', false); // El segundo parámetro indica que no es un archivo real
      
        $response = $this->actingAs($user)->post(route('admin.products.store-excel'), ['file' => $file]);
       
        $response->assertRedirect(route('admin.products.index'));
        $response->assertSessionHas('success', 'Productos importados con exito');
      
    }
}
