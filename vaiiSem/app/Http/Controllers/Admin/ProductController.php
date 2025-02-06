<?php

namespace App\Http\Controllers\Admin;
use App\Models\Category;
use App\Models\Product;
use App\Models\Review;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
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
    
        $product->description = $request->input('description');
        $product->price = $request->input('price');
        $product->save();
        $product->slug = $product->id;
        $product->save();
        return redirect('/dashboard')->with('success', 'Produkt bol pridaný.');
    }

    public function edit($id) {

        $product = Product::find($id);
        $categories = Category::all();
        return view("layouts.admin.product.edit", compact('product', 'categories'));
    }

    public function update(Request $request, $id)
{
    $product = Product::find($id);

    $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'required|string',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    if ($request->has('delete_image') && $product->image) {
        $path = 'ProductImages/uploads/products/' . $product->image;
        if (File::exists($path)) {
            File::delete($path);
        }
        $product->image = null; 
    }


    if ($request->hasFile('image')) {
        $path = 'ProductImages/uploads/products/' . $product->image;
        if (File::exists($path)) {
            File::delete($path);
        }

        $file = $request->file('image');
        $ext = $file->getClientOriginalExtension();
        $filename = time() . '.' . $ext;
        $file->move('ProductImages/uploads/products/', $filename);
        $product->image = $filename;
    }


    $product->name = $request->input('name');
    $product->description = $request->input('description');
    $product->price = $request->input('price');
    $product->categories()->sync($request->categories ?? []);
    $product->update();

    $product->slug = $product->id;
    return redirect('products')->with('success', 'Product updated successfully!');
}


    public function deleteProduct($id) {
        $product = Product::find($id);

        if($product->image)
        {
            $path = "ProductImages/uploads/products/".$product->image;
            if (File::exists($path)) {
                File::delete($path);
            }
        }
        $product->delete();
        return redirect('products');
        
    }



    public function search(Request $request)
{
    $query = $request->input('query');
    $categories = $request->input('categories', []);
    $page = $request->input('page', 1);
    $sortBy = $request->input('sortBy', 'price_asc');
    
    $productsQuery = Product::query()
        ->where(function ($queryBuilder) use ($query) {
            $queryBuilder->where('name', 'LIKE', "%{$query}%")
                         ->orWhere('description', 'LIKE', "%{$query}%");
        })
        ->when(!empty($categories), function ($queryBuilder) use ($categories) {
            $queryBuilder->whereHas('categories', function ($query) use ($categories) {
                $query->whereIn('category_product.category_id', $categories); 
            });
        })
        ->when($sortBy, function ($queryBuilder) use ($sortBy) {
            switch ($sortBy) {
                case 'price_asc':
                    $queryBuilder->orderBy('price', 'asc');
                    break;
                case 'price_desc':
                    $queryBuilder->orderBy('price', 'desc');
                    break;
                case 'rating_asc':
                    $queryBuilder->orderBy('rating', 'asc');
                    break;
                case 'rating_desc':
                    $queryBuilder->orderBy('rating', 'desc');
                    break;
                default:
                    $queryBuilder->orderBy('price', 'asc');
                    break;
            }
        });
    $products = $productsQuery->paginate(6);

    // Posielať odpoveď vo formáte JSON
    return response()->json($products);
}

    
    

    public function show($id)
    {
        $product = Product::findOrFail($id);
        $reviews = $product->reviews;
        return view('showProduct', compact('product', 'reviews'));
    }

    public function storeReview(Request $request, $productId)
    {
        $request->validate([
            'author' => 'required|string|max:255',
            'review' => 'required|string|max:1000',
            'rating' => 'required|integer|between:1,5',
        ]);

        $review = new Review();
        $review->product_id = $productId;
        $review->author = $request->author;
        $review->review = $request->review;
        $review->rating = $request->rating;
        $review->save();

        return redirect()->route('product.show', $productId)->with('success', 'Recenzia bola pridaná.');
    }


    public function attachCategory($productId, $categoryId) {
        $product = Product::find($productId);
        $product->categories()->attach([$categoryId]);
        return redirect('edit-product/' . $productId);
    }



}
