<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('search');
        $category = $request->input('category');

        $products = Product::query()
            ->when($query, function ($query, $search) {
                return $query->where(function ($query) use ($search) {
                    $query->where('title', 'LIKE', '%' . $search . '%')
                        ->orWhere('description', 'LIKE', '%' . $search . '%');
                });
            })
            ->when($category, function ($query, $category) {
                return $query->where('category_id', $category);
            })
            ->available()
            ->paginate(8);

        $categories = Category::all();

        return view('welcome', compact('products', 'categories'));
    }

    public function show(Product $product)
    {
        $firstThreeProducts = Product::query()->available()->take(3)->get();

        return view('products.show', compact('product', 'firstThreeProducts'));
    }


    //
}
