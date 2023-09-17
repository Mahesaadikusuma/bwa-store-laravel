<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Product;

class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // take itu untuk memanggil data category max 6 saja dan get itu untuk memanggil semua data yang telah di tentuin
        $categories = Category::take(6)->get();
        $produts = Product::with(['galleries'])->take(8)->get();
        
        return view('pages.home', [
            'categories' => $categories,
            'produts' => $produts,
        ]);
    }
}
