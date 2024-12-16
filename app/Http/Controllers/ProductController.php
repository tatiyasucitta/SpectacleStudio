<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class ProductController extends Controller
{
    public function index()
    {
        $products = Product::where('stock', '>', 0)->whereNotNull('stock')->get();
        $cats = Category::all();
        return view('main.home', compact('products', 'cats'));
    }

    public function adminshow(){
        $products = Product::all();
        return view('main.products', ['products'=>$products]);
    }
    
    public function showAllProducts()
    {
        $products = Product::where('stock', '>', 0)->get();        
        return view('main.products', compact('products'));
    }
    
    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('main.detail', compact('product'));
    }

    public function showByCategory($id)
    {
        $products = Product::where('category_id', $id)->get();
        return view('main.products', compact('products'));
    }

    public function createForm(){
        return view('main.add', ['cats'=> Category::all()]);
    }

    public function create(request $request){
        // dd($request);
        $request->validate([
            'name'=>'required|min:5|max:80',
            'category_id' =>'required',
            'description' => 'required',
            'image' => 'required|mimes:jpeg, png, jpg',
            'price'=>'required|numeric',
            'stock'=>'required|numeric'
        ]);

        $file = $request->file('image');
        $contents = file_get_contents($file->getRealPath());
        $base64 = base64_encode($contents);
        $mimeType = $file->getMimeType();
        $base64Data = 'data:' . $mimeType . ';base64,' . base64_encode($contents);
        
        Product::create([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'description' => $request->description,
            'image'=> $base64Data,
            'price' => $request->price,
            'stock' => $request->stock
        ]);
        
        return redirect('/admin/dashboard')->with('success', 'Product added!');
    }

    public function update($id){
        $products = Product::find($id);
        $cat = Category::where('id', '!=', $products->category_id)->get();
        return view('main.update', [
            'item'=>$products,
            'cat'=> $cat
        ]);
    }

    public function updated(request $request, $id){
        $products = Product::find($id);
        // dd($request);

        $request->validate([
            'name'=>'required|min:5|max:80',
            'category_id' =>'required',
            'image' => 'required|mimes:jpeg,png,jpg',
            'price'=>'required|numeric',
            'stock'=>'required|numeric'
        ]);

        $file = $request->file('image');
        $contents = file_get_contents($file->getRealPath());
        $base64 = base64_encode($contents);
        $mimeType = $file->getMimeType();
        $base64Data = 'data:' . $mimeType . ';base64,' . base64_encode($contents);

        
        $products->update([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'image' =>$base64Data,
            'price' => $request->price,
            'stock' => $request->stock
        ]);
        return redirect('/admin/dashboard')->with('success', 'Item Updated!');
    }

    public function delete($id){
        $item = Product::find($id);
        $item->delete();

        return redirect('/admin/dashboard');
    }
}
