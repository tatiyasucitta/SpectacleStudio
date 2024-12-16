<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function categoriesPage()
    {
        $categories = Category::all();
        return view('main.categories', compact('categories'));
    }

    public function create(){
        return view('main.createcategory');
    }

    public function created(Request $request){
        $request->validate([
            'categoryName' => 'required',
            'image' => 'required|mimes:jpeg, png, jpg',
        ]);

        $file = $request->file('image');
        $contents = file_get_contents($file->getRealPath());
        $base64 = base64_encode($contents);
        $mimeType = $file->getMimeType();
        $base64Data = 'data:' . $mimeType . ';base64,' . base64_encode($contents);

        category::create([
            'name' => $request->categoryName,
            'image'=> $base64Data
        ]);

        return redirect('/admin/dashboard')->with('success', 'category created!');
    }
    public function updateForm($id){
        $cat = Category::find($id);
        return view('main.updatecategory', ['cat'=> $cat]);
    }

    public function update(request $request, $id){
        $cat = Category::find($id);
        // dd($request);

        $request->validate([
            'name'=>'required',
            'image' => 'required|mimes:jpeg,png,jpg',
        ]);

        $file = $request->file('image');
        $contents = file_get_contents($file->getRealPath());
        $base64 = base64_encode($contents);
        $mimeType = $file->getMimeType();
        $base64Data = 'data:' . $mimeType . ';base64,' . base64_encode($contents);

        
        $cat->update([
            'name' => $request->name,
            'image' =>$base64Data
        ]);
        return redirect('/categories')->with('success', 'Item Updated!');
    }

    public function delete($id){
        $item = Category::find($id);
        $item->delete();

        return redirect('/admin/dashboard');
    }
}
