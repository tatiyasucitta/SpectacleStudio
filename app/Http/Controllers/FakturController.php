<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Faktur;
use App\Models\Cart;
use App\Models\Product;


class FakturController extends Controller
{
    public function save(Request $request, $id){
        // dd($request);
        $faktur = Faktur::create([
            'invoice'=> $request->invoice,
            'user_id' => $id
        ]);

        $items= Cart::all();

        for($i=0 ; $i< count($items) ; $i++){
            if(!$items[$i]->invoice_id){
                $items[$i]->invoice_id = $request->invoice;
                $items[$i]->faktur_id = $faktur->id;
                $items[$i]->save();
            }
        }

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
                $a++;
            }
        }
     
        return redirect('/')->with('success', 'facture saved in history!');
    }
    
    public function history(){
        $faktur = faktur::All();
        return view('main.history', ['fakturs'=> $faktur]);
    }

    public function detailinvoice($id){
        $faktur = Faktur::find($id);
        $invoice = $faktur->invoice;
        $cart = Cart::where('invoice_id', $invoice)->get();

        $total =0;

        for($i =0 ; $i < count($cart) ; $i++){
            $total += $cart[$i]->product[0]->price*$cart[$i]->quantity;
        }

        return view('main.detailInvoice', ['items'=> $cart,
                                        'total'=> $total,
                                        'invoice'=> $invoice]);
    }
}
