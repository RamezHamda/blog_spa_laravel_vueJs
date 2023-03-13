<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:categories',
        ]);

        $name = $request->input('name');
        $category = new Category();
        $category->name = $name;

        return $category->save();
    }

    public function index()
    {
        $categories = Category::latest()->get();
        return $categories;
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|unique:categories',
        ]);

        $name = $request->input('name');
        // $category = Category::find($category);
        $category->name = $name;

        return $category->save();

        
    }

    public function show($category)
    {
        return Category::find($category);
        
    }

    public function destroy(Category $category)
    {
        return $category->delete();
    }
}