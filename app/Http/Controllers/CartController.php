<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cart;
use Illuminate\Support\Facades\Auth;
class CartController extends Controller
{
    public function index() {
        // model cart ambil product dan juga gallery sama user 
        // where itu cuma bisa di akses oleh user yang sudah login 
        $carts = Cart::with(['product.galleries', 'user'])
            ->where('users_id', Auth::user()->id)
            ->get();
            
        return view('pages.cart',[
            'carts' => $carts,
        ]);
    }

    public function delete(Request $request, $id) {
        $carts = Cart::findOrFail($id);

        $carts->delete();

        return redirect()->route('cart');
    }

    public function success() {
        return view('pages.success');
    }
}
