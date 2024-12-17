<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Models\Faktur;
use Illuminate\Support\Str;

use Illuminate\Http\Request;

class CartController extends Controller
{
    public function viewCart()
    {
        $item = Cart::all();        
        $items = array();
        $total = 0;
        $a =0;
        for($i=0 ; $i< count($item) ; $i++){
            if(!$item[$i]->faktur_id){
                $items[$a] = $item[$i];
                $a++;
            }
        }

        for($i = 0 ; $i< count($items) ; $i++){
            $total += $items[$i]->product[0]->price*$items[$i]->quantity;
        }
        return view('main.cart', ['items'=>$items,
                    'total' => $total]);
    }

    public function addToCart(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $cartItem = Cart::where('product_id', $id)->first();
        if ($cartItem && !$cartItem->invoice_id) {
            $cartItem->quantity += $request->input('quantity', 1);
            
            $cartItem->save();
        } else {
            Cart::create([
                'product_id' => $product->id,
                'quantity' => $request->quantity,
            ]);

        }


        return redirect()->route('cart.view')->with('success', 'Product added to cart!');
    }

    public function removeFromCart($id)
    {
        $cartItem = Cart::findOrFail($id);
        $cartItem->delete();

        return redirect()->route('cart.view')->with('success', 'Product removed from cart!');
    }

    public function faktur(){
        $item = Cart::all();
        $invoice = '000.' . rand(100,1000) . '-' . Str::random(10) . '.' . rand(100,1000);
        $items = array();
        $a =0;
        
        for($i=0 ; $i< count($item) ; $i++){
            if(!$item[$i]->faktur_id){
                $items[$a] = $item[$i];
                $a++;
            }
        }
        // dd($items);
        $total = 0;
        
        for($i = 0 ; $i< count($items) ; $i++){
            $total += $items[$i]->product[0]->price*$items[$i]->quantity;
        }
        // dd($total);
        return view('main.checkout', ['items'=>$items,
        'total' => $total,
        'invoice'=> $invoice]);
    }
}
