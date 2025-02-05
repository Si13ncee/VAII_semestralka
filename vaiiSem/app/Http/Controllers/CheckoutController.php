<?php

namespace App\Http\Controllers;
use App\Models\OrderItem;
use App\Models\Order;
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

    foreach (session('cart', []) as $item) { 
        OrderItem::create([
            'order_id' => $order->id,
            'product_name' => $item['name'], 
            'price' => $item['price'],
            'quantity' => $item['pocet'],
        ]);
    }

    session()->forget('cart');

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
