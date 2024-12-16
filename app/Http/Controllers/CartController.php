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
        // dd($items);

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
        if ($cartItem) {
            $cartItem->quantity += $request->input('quantity', 1);
            $cartItem->save();
        } else {
            Cart::create([
                'product_id' => $product->id,
                'quantity' => $request->input('quantity', 1),
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

    public function checkout(){
        $item = Cart::all();
        $items = array();
        $a =0;
        for($i=0 ; $i< count($item) ; $i++){
            if(!$item[$i]->faktur_id){
                $items[$a] = $item[$i];
                $a++;
            }
        }
        $invoice = '000.' . rand(100,1000) . '-' . Str::random(10) . '.' . rand(100,1000);
        $faktur = Faktur::create([
            'invoice'=> $invoice
        ]);
        // $id = Faktur::latest('id')->first();
        for($i= 0 ; $i< count($items) ; $i++){
            $items[$i]->invoice_id = $invoice;
            $items[$i]->faktur_id = $faktur->id;
            $items[$i]->save();
        }
        return redirect('/faktur');
    }

    public function faktur(){
        $cart = Cart::all();
        $faktur = Faktur::latest('id')->first();
        $invoice = $faktur->invoice;
        $a =0;
        $items = array();
        for($i =0 ; $i <count($cart) ; $i++){
            if($cart[$i]->invoice_id == $invoice){
                $items[$a] = $cart[$i];
                $a++;
            }
        }
        $total = 0;
        // dd($items);  
        
        for($i = 0 ; $i< count($items) ; $i++){
            $total += $items[$i]->product[0]->price*$items[$i]->quantity;
        }
        return view('main.checkout', ['items'=>$items,
        'total' => $total,
        'invoice'=> $invoice]);
    }
}
