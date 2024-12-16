<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function create(){
        return view('main.createcategory');
    }

    public function created(Request $request){
        $request->validate([
            'categoryName' => 'required'
        ]);

        category::create([
            'name' => $request->categoryName
        ]);

        return redirect('/admin/dashboard')->with('success', 'category created!');
    }
}
