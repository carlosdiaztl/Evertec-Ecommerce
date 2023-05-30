<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;

class AdminHomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:admin.users.index');
    }

    //

    public function index()
    {
        // $products = Product::query()->available()->paginate(5);
        // dd($products);
        return view('admin.home');
    }
    //
}
