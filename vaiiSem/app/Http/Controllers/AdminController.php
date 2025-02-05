<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class AdminController extends Controller
{
    public function index()
    {
        return view('layouts.admin.index'); // Return the admin dashboard view
    }


    // Add more methods for different functionalities (e.g., addProduct, removeProduct, viewOrders, etc.)
}