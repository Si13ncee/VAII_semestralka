<?php

namespace App\Http\Controllers\Admin;
use App\Models\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NewProductController extends Controller
{
    public function index() {
        $products = Product::all();
        return view("layouts.admin.product.index", compact('products'));
    }

    public function add() {
        return view("layouts.admin.product.add");        
    }

    public function insert(Request $request) {
        $product = new Product();
        if ($request->hasFile('image'))
        {
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time().'.'.$ext;
            $file->move('ProductImages/uploads/products/' , $filename);
            $product->image = $filename;
        }

        $product->name = $request->input('name');
        $product->slug = $request->input('slug');
        $product->description = $request->input('description');
        $product->meta_title = $request->input('meta_title');
        $product->meta_description = $request->input('meta_description');
        $product->meta_keywords = $request->input('meta_keywords');
        $product->save();
        return redirect('/dashboard')->with('status', "Product added Succesfully!");
    }
}
