<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class FrontendController extends Controller
{
    public function index() {
        $unprocessedOrders = Order::where('status', 'pending')->count(); 
        return view('layouts.admin.index', compact('unprocessedOrders'));
    }
}
