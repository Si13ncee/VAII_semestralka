<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function addToCart(Request $request, $productId)
    {
        $product = Product::findOrFail($productId);

        if (Auth::check()) {
            // Ak je používateľ prihlásený, ulož do databázy
            $cartItem = CartItem::where('user_id', Auth::id())->where('product_id', $productId)->first();

            if ($cartItem) {
                $cartItem->increment('pocet');
            } else {
                CartItem::create([
                    'user_id' => Auth::id(),
                    'product_id' => $productId,
                    'pocet' => 1
                ]);
            }
        } else {
            // Ak nie je prihlásený, ulož do session
            $cart = session()->get('cart', []);
            if (isset($cart[$productId])) {
                $cart[$productId]['pocet']++;
            } else {
                $cart[$productId] = [
                    'name' => $product->name,
                    'price' => $product->price,
                    'pocet' => 1
                ];
            }
            session()->put('cart', $cart);
        }

        return back()->with('success', 'Produkt bol pridaný do košíka!');
    }

    public function showCart()
{
    if (Auth::check()) {
        $cartItems = CartItem::where('user_id', Auth::id())->with('product')->get();
    } else {
        $cartItems = session()->get('cart', []);
    }

    return view('cart', compact('cartItems'));
}



}
