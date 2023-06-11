<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request){

        $query = $request['search'];
        $category = $request['category']; 
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
            ->with('category')
            ->paginate(8);

        return response()->json($products);

    }
    //
}
