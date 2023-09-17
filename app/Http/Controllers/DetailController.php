<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Cart;
use Illuminate\Support\Facades\Auth;


class DetailController extends Controller
{
    public function index(Request $request, $id) {
        // firstOrFail itu adalah ambil data product yang berelasi dengan gallery dan juga user jika ada maka data itu di munculkan jikan tidak ada akan error atau tidak muncul
        $product = Product::with(['galleries','user'])->where('slug', $id)->firstOrFail();

        return view('pages.details', [
            'product' => $product
        ]);
    }

    public function add(Request $request, $id)
    {
        $data = [
            'products_id' => $id,
            'users_id' => Auth::user()->id
        ];

        Cart::create($data);

        return redirect()->route('cart');
    }

}
