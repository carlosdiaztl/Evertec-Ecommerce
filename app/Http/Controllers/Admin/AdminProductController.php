<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Product\AdminProductStore;
use App\Http\Requests\Admin\Product\AdminProductUpdate;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::paginate(7);

        return view('admin.products.index', compact('products'));
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $statuses = Product::distinct()->pluck('status');
        // dd($status);
        return view('admin.products.create', compact('categories', 'statuses'));
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AdminProductStore $request)
    {
        $path = $request['image']->store('public/images');
        $newpath = str_replace("public/images", "", $path);
        Product::create([
            'title' => $request['title'],
            'image' => $newpath,
            'category_id' => $request['category_id'],
            'description' => $request['description'],
            'status' => $request['status'],
            'price' => $request['price'],
            'stock' => $request['stock']
        ]);
        return redirect()->back()->withSuccess('Producto creado ');

        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $categories = Category::all();
        $statuses = Product::distinct()->pluck('status');
        return view('admin.products.edit', compact('product', 'categories', 'statuses'));
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AdminProductUpdate $request, Product $product)
    {
        if ($request->hasFile('image') &&  ($request['image'] != $product->image)) {
            // dd($product->image);
            Storage::delete('public/images' . $product->image);
            $path = $request['image']->store('public/images');
            $newpath = str_replace("public/images", "", $path);
            $product->update([
                'image' => $newpath,
                'title' => $request['title'],
                'description' => $request['description'],
                'status' => $request['status'],
                'category_id' => $request['category_id'],
                'stock' => $request['stock'],
                'price' => $request['price']
            ]);
            return redirect()->route('admin.products.index')->withSuccess('Producto actualizado. ');
        }
        $product->update($request->validated());
        return redirect()->route('admin.products.index')->withSuccess('Producto actualizado ');
        // dd($request);
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->back()->withSuccess('Product deleted');
        //
    }
}
