<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Faktur;
use App\Models\Cart;
use App\Models\Product;


class FakturController extends Controller
{
    public function save(Request $request){
        // dd($request);
        $faktur = Faktur::create([
            'invoice'=> $request->invoice
        ]);
        $items= Cart::all();

        for($i=0 ; $i< count($items) ; $i++){
            if(!$items[$i]->invoice_id){
                $items[$i]->invoice_id = $request->invoice;
                $items[$i]->faktur_id = $faktur->id;
                $items[$i]->save();
            }
        }
        // $id = Faktur::latest('id')->first();
        // dd($faktur);
        $request->validate([
            'name'=>'required|string|min:5|max:100',
            'phone'=>'required|string|min:5|max:100',
            'address'=>'required|string|min:5|max:100'
        ]);

        $faktur->update([
            'name' =>$request->name,
            'phone' =>$request->phone,
            'address' =>$request->address,
        ]);

        $cart= Cart::all();
        $invoice = $faktur->invoice;
        $a =0;
        for($i =0 ; $i <count($cart) ; $i++){
            if($cart[$i]->invoice_id == $invoice){
                $product = Product::where('id', $cart[$i]->product_id)->first();
                $product->stock -= $cart[$i]->quantity;
                $product->save();
                // dd($product);
                $a++;
            }
        }
        // $product = Product::where('id', $cart[$i]->product_id)->first();
        // $product->quantity -= $cart[$i]->quantity;

        return redirect('/')->with('success', 'facture saved in history!');
    }
    
    public function history(){
        $faktur = faktur::All();
        return view('main.history', ['fakturs'=> $faktur]);
        // $ada = Cart::where('item_id', $id)->first();
    }

    public function detailinvoice($id){
        $faktur = Faktur::find($id);
        $invoice = $faktur->invoice;
        $cart = Cart::all();
        $items = array();
        $a=0;
        for($i = 0; $i < count($cart) ; $i++){
            if($cart[$i]->faktur_id == $id){
                $items[$a] = $cart[$i];
                $a++;
            }
        }
        $total =0;
        for($i =0 ; $i < $a ; $i++){
            $total += $items[$i]->product[0]->price*$items[$i]->quantity;
        }
        // dd($items);
        return view('main.detailInvoice', ['items'=> $items,
                                        'total'=> $total,
                                        'invoice'=> $invoice]);
    }
}
