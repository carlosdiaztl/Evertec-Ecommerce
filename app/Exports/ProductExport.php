<?php

namespace App\Exports;

use App\Models\Product;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ProductExport implements FromView 
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        $products = Product::all();

        return view('admin.products.export-excel', compact('products'));
    }
}
