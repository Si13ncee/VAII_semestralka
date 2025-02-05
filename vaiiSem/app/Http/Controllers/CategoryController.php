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

}
