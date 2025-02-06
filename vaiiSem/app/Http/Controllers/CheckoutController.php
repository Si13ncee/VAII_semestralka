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
        // Ak je používateľ prihlásený, použijeme údaje z databázy.
        if (Auth::check()) {
            // Získame položky košíka prihláseného používateľa
            $cartItems = CartItem::where('user_id', Auth::id())->get();
        } else {
            // Ak nie je prihlásený, použijeme položky zo session
            $cartItems = session('cart', []);
        }
    
        // Vytvorenie objednávky
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
    
        // Nastavenie user_id pre prihláseného používateľa
        $order->user_id = Auth::check() ? Auth::id() : null;
        $order->save(); // Nezabudnite uložiť objednávku do databázy

        
        foreach ($cartItems as $item) {
            $productName = Product::find($item->product_id)->name;
            $price = Product::find($item->product_id)->price;
            
            OrderItem::create([
                'order_id' => $order->id,
                'product_name' => $productName, // Ak je z databázy, inak zo session
                'price' => $price,
                'quantity' => $item['pocet'],
            ]);
        }
    
        // Ak je používateľ prihlásený, môžeme odstrániť položky z databázy
        if (Auth::check()) {
            CartItem::where('user_id', Auth::id())->delete(); // Vymažte položky po vytvorení objednávky
        } else {
            // Ak je používateľ neprihlásený, vymažeme položky zo session
            session()->forget('cart');
        }
    
        // Presmerujeme používateľa na katalog alebo iné miesto
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
