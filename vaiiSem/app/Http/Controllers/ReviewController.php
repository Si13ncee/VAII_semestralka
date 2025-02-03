<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function store(Request $request, $productId)
{
    // Validácia vstupných dát
    $request->validate([
        'review' => 'required|string|max:1000',
        'rating' => 'required|integer|min:1|max:5',
    ]);

    // Uloženie recenzie
    $review = new Review();
    $review->product_id = $productId;
    $review->author = auth()->user()->name; // Automatické získanie mena prihláseného užívateľa
    $review->review = $request->review;
    $review->rating = $request->rating;
    $review->save();

    // Aktualizácia ratingu a rating_count produktu
    $this->updateProductRating($productId);

    return redirect()->route('showProduct', $productId)->with('success', 'Recenzia bola pridaná!');
}

public function updateProductRating($productId)
{
    // Získanie všetkých recenzií pre daný produkt
    $reviews = Review::where('product_id', $productId)->get();

    // Vypočítanie priemerného hodnotenia
    $averageRating = $reviews->avg('rating');

    // Počet recenzií
    $ratingCount = $reviews->count();

    // Aktualizácia ratingu a rating_count produktu
    $product = Product::find($productId);
    $product->rating = round($averageRating, 1); // Zaokrúhlenie na 1 desatinné miesto
    $product->rating_count = $ratingCount;
    $product->save();
}
    
public function loadReviews(Request $request, $productId)
{
    $page = $request->page ?: 1;  // Získajte aktuálnu stránku
    $reviewsPerPage = 4;  // Počet recenzií na jednu stránku

    $reviews = Review::where('product_id', $productId)
                     ->orderBy('created_at', 'desc')  // Zoradiť podľa dátumu
                     ->skip(($page - 1) * $reviewsPerPage)  // Preskočiť predchádzajúce recenzie
                     ->take($reviewsPerPage)  // Zobraziť iba požadovaný počet recenzií
                     ->get();

    return response()->json($reviews);
}


}
