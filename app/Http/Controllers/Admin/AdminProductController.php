<?php

namespace App\Http\Controllers\Admin;

use App\Constants;
use App\Exports\ProductExport;
use App\Imports\ProductImport;
use App\Models\Product;
use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Admin\Product\AdminProductStore;
use App\Http\Requests\Admin\Product\AdminProductUpdate;
use App\Http\Requests\Imports\ExcelProductRequest;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Illuminate\Http\Request;

class AdminProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::query()->paginate(7);

        return view('admin.products.index', compact('products'));
        //
    }
    public function exportExcel()
    {
        return Excel::download(new ProductExport(), 'products.xlsx');
    }
    public function exportPDF()
    {
        $products = Product::all();
        $pdf = FacadePdf::loadView('admin.products.export-excel', compact('products'));

        return $pdf->download('product-list.pdf');
    }
    public function importExcel(ExcelProductRequest $request){
       $file=$request->file('import_file');
       Excel::import(new ProductImport,$file);
      return redirect()->route('admin.products.index')->with('success','Productos importados con exito');

    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $statuses = Constants::getProductStatusOptions();
        // dd($status);
        return view('admin.products.create', compact('categories', 'statuses'));
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AdminProductStore $request)
    {
        if ($request->hasFile('image')) {

       
        $path = $request['image']->store('public/images');
        $newpath = str_replace("public", "storage", $path);
        $product = new Product([
            'title' => $request['title'],
            'image' => $newpath,
            'category_id' => $request['category_id'],
            'description' => $request['description'],
            'status' => $request['status'],
            'price' => $request['price'],
            'stock' => $request['stock'],
        ]);
        $product->save();

        return redirect()->back()->with(['success' => 'Producto creado']);
         }
         $product= new Product($request->validated());
         $product->save();
         
         return redirect()->back()->with(['success' => 'Producto creado']);
         

        //
    }


    public function show(Product $product)
    {
        return view('admin.products.show', compact('product'));
        //
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        $statuses = Constants::getProductStatusOptions();

        return view('admin.products.edit', compact('product', 'categories', 'statuses'));
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AdminProductUpdate $request, Product $product)
    {
        if ($request->hasFile('image')) {

            Storage::delete('public/images' . $product->image);
            $path = $request['image']->store('public/images');
            $newpath = str_replace("public", "storage", $path);
            $product->update([
                'image' => $newpath,
                'title' => $request['title'],
                'description' => $request['description'],
                'status' => $request['status'],
                'category_id' => $request['category_id'],
                'stock' => $request['stock'],
                'price' => $request['price'],
            ]);

            return redirect()->route('admin.products.index')->with(['success' => 'Producto actualizado.']);
        }
        $product->update($request->validated());

        return redirect()->route('admin.products.index')->with(['success' => 'Producto actualizado.']);
        // dd($request);
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $filePath = public_path($product->image);
        // Verificar si el archivo existe y eliminarlo si es así
        if (file_exists($filePath)) {
            Storage::delete('public/images/' . $product->image);
            unlink($filePath);
        }
        $product->delete();

        return redirect()->back()->with(['success' => 'Producto eliminado']);
        //
    }
}
