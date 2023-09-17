<?php

namespace App\Http\Controllers;

use App\Product;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Admin\ProductRequest;
use App\ProductGallery;
use App\User;
use Illuminate\Support\Str;

class DashboardProductController extends Controller
{
    public function index() {
        $products = Product::with('galleries', 'category')
            ->where('users_id', Auth::user()->id)->paginate(8);

        return view('pages.dashboard-product',[
            'products' => $products
        ]);
    }

    public function create() {
        $users = User::all();

        $categories = Category::all();
        return view('pages.dashboard-product-create',[
            'users' => $users,
            'categories' => $categories
        ]);
    }

    public function details(Request $request, $id) 
    {
        $product = Product::with(['galleries', 'category', 'user'])->findOrFail($id);
        $categories =  Category::all();
        
        return view('pages.dashboard-product-details', [ 
            'categories' => $categories,
            'product' => $product,
        ]);
        
    }

    public function uploadGallery(Request $request)
    {
        // data itu variabel baru
        // ambil semua product request dan masukan ke dalam variabel data
        $data = $request->all();
        
        $data['photos'] = $request->file('photos')->store('assets/product', 'public');

        ProductGallery::create($data);

        return redirect()->route('dashboard-product-details', $request->products_id);
    }

    public function deleteGallery(Request $request, $id) 
    {
        $item = ProductGallery::findOrFail($id);

        $item->delete();

        return redirect()->route('dashboard-product-details', $item->products_id);
    }

    public function store(ProductRequest $request)
    {
        // data itu variabel baru
        // ambil semua product request dan masukan ke dalam variabel data
        $data = $request->all();

        $data['slug'] = Str::slug($request->name);
        $product = Product::create($data);
        // Product::create($data);

        $gallery = [
            'products_id' => $product->id,
            'photos' => $request->file('photo')->store('assets/product', 'public')
        ];

        ProductGallery::create($gallery);
        return redirect()->route('dashboard-product');
    }


    public function update(ProductRequest $request, $id)
    {
        $data = $request->all();

        $item = Product::findOrFail($id);

        $data['slug'] = str::slug($request->name);

        $item->update($data);

        return redirect()->route('dashboard-product');
    }
}
