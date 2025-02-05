<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Order;

class FrontendController extends Controller
{
    public function index() {
        $unprocessedOrders = Order::where('status', 'pending')->count(); 
        $items = Product::count('id');
        $noUsers = User::count('id');
        return view('layouts.admin.index', compact('unprocessedOrders', 'items', 'noUsers'));
    }
}
