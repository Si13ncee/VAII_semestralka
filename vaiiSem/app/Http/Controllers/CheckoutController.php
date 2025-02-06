<?php

namespace App\Http\Controllers;
use App\Models\CartItem;
use App\Models\OrderItem;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    
    public function address()
    {
        return view('checkout.address');
    }

    public function review(Request $request)
    {
        
        if (Auth::check()) {
            
            $cartItems = CartItem::where('user_id', Auth::id())->get();
        } else {
            
            $cartItems = session('cart', []);
        }
    

        $order = Order::create([
            'name' => $request->name,
            'email' => $request->email,
            'address' => $request->address,
            'city' => $request->city,
            'postal_code' => $request->postal_code,
            'phone_number' => $request->phone_number,
            'total_price' => $this->calculateTotalPrice(),
            'status' => 'pending',
        ]);
    
        $order->user_id = Auth::check() ? Auth::id() : null;
        $order->save();

        
        foreach ($cartItems as $item) {
            if (Auth::check()) {
                $product = Product::find($item->product_id);
                $productName = $product->name;
                $price = $product->price;
                $quantity = $item->quantity; 
            } else {

                $productName = $item['name'];
                $price = $item['price'];
                $quantity = $item['pocet'];
            }
            
            
            OrderItem::create([
                'order_id' => $order->id,
                'product_name' => $productName, 
                'price' => $price,
                'quantity' => $item['pocet'],
            ]);
        }
    
        if (Auth::check()) {
            CartItem::where('user_id', Auth::id())->delete();
        } else {
           
            session()->forget('cart');
        }
    

        return redirect()->route('catalogue');
    }
    

public function calculateTotalPrice()
{
    $cartItems = session('cart', []);
    $totalPrice = 0;

    foreach ($cartItems as $item) {
        
        $totalPrice += $item['price'] * $item['pocet'];
    }

    return $totalPrice;
}


}
