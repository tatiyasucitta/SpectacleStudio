<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function checkout(Request $request)
{
    Order::create([
        'customer_name' => $request->customer_name,
        'customer_email' => $request->customer_email,
        'address' => $request->address,
    ]);
    Cart::truncate();
    return redirect('/')->with('success', 'Order placed successfully!');
}
}
