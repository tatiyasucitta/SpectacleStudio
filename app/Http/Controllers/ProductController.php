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
        $products = Product::all();
        $cats = Category::all();
        return view('main.home', compact('products', 'cats'));
    }
    public function adminshow(){
        $products = Product::all();
        return view('main.products', ['products'=>$products]);
    }
    
    public function showAllProducts()
    {
        $products = Product::all();
        return view('main.products', compact('products'));
    }
    
    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('main.detail', compact('product'));
    }

    public function productsPage()
    {
        $products = Product::all();
        return view('main.products', compact('products'));
    }

    public function categoriesPage()
    {
        $categories = Category::all();
        return view('main.categories', compact('categories'));
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
            'image' => 'mimes:jpeg, png, jpg',
            'price'=>'required|numeric',
            'stock'=>'required|numeric'
        ]);

        $input = $request->all();

        if($request->hasFile('image')){
            $destination_path = 'public/images/products';
            $image = $request->file('image');
            $img_name = $image->getClientOriginalName();
            $image_name = Str::random(3) . '_' . $img_name;
            $path = $request->file('image')->storeAs($destination_path, $image_name);
        
            $input['image'] = $image_name;
        }
        
        Product::create([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'description' => $request->description,
            'image'=> $image_name,
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

        $input = $request->all();

        if($request->hasFile('image')){
            $destination_path = 'public/images/products';
            $image = $request->file('image');
            $img_name = $image->getClientOriginalName();
            $image_name = Str::random(10) . '_' . $img_name;
            $path = $request->file('image')->storeAs($destination_path, $image_name);
        
            $input['image'] = $image_name;
        }

        
        $products->update([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'image' =>$image_name,
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
