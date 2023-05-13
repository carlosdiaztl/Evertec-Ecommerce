<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Category\CategoryFormStore;
use App\Http\Requests\Admin\Category\CategoryFormUpdate;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::query()->paginate();
        return view('admin.categories.index', compact('categories'));
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.categories.create');
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryFormStore $request)
    {
        $category = new category($request->validated());
        $category->save();
        return redirect()->back()->withSuccess('Categoria creada ');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return view('admin.categories.show', compact('category'));


        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryFormUpdate $request, Category $category)
    {
        $category->update($request->validated());
        return redirect()->back()->withSuccess('Category updated');
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->products()->delete();
        $category->delete();
        return redirect()->back()->withSuccess('Categoria eliminada');
        //
    }
}
