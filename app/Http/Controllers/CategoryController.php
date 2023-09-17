<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\CategoryRequest;
use Illuminate\Http\Request;
use App\Category;
use App\Product;
class CategoryController extends Controller
{
    public function index() {

        $categories = Category::all();
        $produts = Product::with(['galleries'])->paginate(12);

        return view('pages.category', [
            'categories' => $categories,
            'produts' => $produts,
        ]);
    }

    public function details(Request $request, $slug) 
    {

        $categories = Category::all();
        $category = Category::where('slug', $slug)->firstOrFail();
        $produts = Product::with(['galleries'])->where('categories_id', $category->id)->paginate(12);

    

        return view('pages.category', [
            'categories' => $categories,
            'produts' => $produts,
        ]);
    }
    
}
