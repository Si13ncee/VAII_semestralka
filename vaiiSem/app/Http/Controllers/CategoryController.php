<?php

namespace App\Http\Controllers;

use App\Models\Category;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function insert(Request $request) {
        $category = new Category();

        $category->name = $request->name;
        $category->save();
        return redirect('categories')->with('success', 'Kategória bola pridaná.');
    }

    public function index() {
        $categories = Category::all();
        return view('layouts.admin.category.index', compact('categories'));
    }

    public function routeToAdd() {
        return view('layouts.admin.category.add');
    }

    public function edit($id) {
        $category = Category::find($id);
        return view("layouts.admin.category.edit", compact('category'));
        
    }

    public function update(Request $request, $id) {
        $category = Category::find($id);
        $request->validate([
            'name' => 'required|string|max:255',
        ]);
        
        $category->name = $request->name;
        $category->update();

        return redirect('categories')->with('success', 'Product updated successfully!');
        
    }



}
