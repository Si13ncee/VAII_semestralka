<?php

namespace App\Http\Controllers\Admin;
use App\Models\Product;
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
        $product->save();
        $product->slug = $product->id;
        $product->save();
        return redirect('/dashboard')->with('success', 'Produkt bol pridaný.');
    }

    public function edit($id) {

        $product = Product::find($id);
        return view("layouts.admin.product.edit", compact('product'));
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
        $page = $request->input('page', 1);
        $sortBy = $request->input('sortBy', 'price_asc');
    
    
        $products = Product::query()
            ->where('name', 'LIKE', "%{$query}%")
            ->orWhere('description', 'LIKE', "%{$query}%")
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
            })
            ->paginate(6); // počet produktov zobrazených naraz
    
        // Posielať odpoveď vo formáte JSON
        return response()->json($products);
    }
    

    public function show($id)
    {
        $product = Product::findOrFail($id);
        $reviews = $product->reviews; // Získanie recenzií pre tento produkt
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

    

}
