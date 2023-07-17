<?php

namespace App\Http\Controllers\API\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Product\AdminProductStore;
use App\Http\Requests\Admin\Product\AdminProductUpdate;
use App\Models\Product;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $products = Product::query()->paginate(10);

        // Devolver los productos como respuesta JSON
        return response()->json($products);
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AdminProductStore $request)
    {
       
       
        // Crear un nuevo producto en la base de datos
        $product = Product::create([
            'title' => $request->input('title'),
            'category_id' => $request->input('category_id'),
            'description' => $request->input('description'),
            'status' => $request->input('status'),
            'price' => $request->input('price'),
            'stock' => $request->input('stock'),
        ]);

        // Devolver una respuesta JSON con el producto creado
        return response()->json($product, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id): JsonResponse
    {
        $product = Product::find($id);

        if (!$product) {
            // Si no se encuentra el producto, devolver una respuesta 404 Not Found
            return response()->json(['error' => 'Producto no encontrado'], 404);
        }

        // Devolver el producto como respuesta JSON
        return response()->json($product);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AdminProductUpdate $request,$id)
    {
        try {
            $product = Product::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Producto no encontrado'], 404);
        }
        // Actualizar los datos del producto con los valores del request
        $product->update([
            'title' => $request->input('title'),
            'category_id' => $request->input('category_id'),
            'description' => $request->input('description'),
            'status' => $request->input('status'),
            'price' => $request->input('price'),
            'stock' => $request->input('stock'),
        ]);

        // Devolver una respuesta con el producto actualizado
        return response()->json(['success' => 'Producto actualizado']);
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id): JsonResponse
    {
        $product = Product::find($id);

        if (!$product) {
            // Si no se encuentra el producto, devolver una respuesta 404 Not Found
            return response()->json(['error' => 'Producto no encontrado'], 404);
        }
        // Eliminar el producto de la base de datos
        $product->delete();
        // Devolver una respuesta 204 No Content para indicar que el producto fue eliminado
        return response()->json(null, 204);
    }
}
