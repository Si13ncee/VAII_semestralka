<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderAdminController extends Controller
{
    public function index() {
        $orders = Order::all();
        $orderedItems = OrderItem::all();
        return view("layouts.admin.order.index", compact('orders', 'orderedItems'));
    }

    public function viewOrder($id) {
    
        $order = Order::findOrFail($id);
        if ($order->status == 'completed' || $order->status == 'cancelled'){
            return redirect('dashboard');
        }
        $orderedItems = OrderItem::where('order_id', $id)->get();
    
        return view("layouts.admin.order.details", compact('order', 'orderedItems'));
    }

    public function completeOrder($id) {
        $order = Order::findOrFail($id);
        $order->status = 'completed';
        $order->save();

        return redirect('orders');
    }

    public function listOrders() {
        $user = Auth::user();
        $orders = $user->orders;
        $orderedItems = OrderItem::all();

        return view('layouts.myOrders.index', compact('orders', 'orderedItems'));
    }

    public function cancelOrder($id) {
        $order = Order::find($id);
        $order->status = 'cancelled';
        $order->save();
        return redirect()->route('myOrders');
    }
    
}
