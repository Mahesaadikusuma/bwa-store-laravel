<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
use App\User;
use App\Category;
use App\Http\Requests\Admin\ProductRequest;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // INI ITU AJAX
        if(request()->ajax())
        {
            // ini untuk memanggil model product dengan relasi user dan category 
            // jadi di dalam model product memanggil model user dan juga category]
            //->withTrashed() itu untuk memanggil data yang telah dihapus pakai soft delete 
            // jika ada softdelet datanya akan dihapus tetapi di database tidak dihapus dan 
            // ->withTrashed() itu memanggil data yang dihapus
            $query = Product::with(['user', 'category']);
            
             return Datatables::of($query)
                ->addColumn('action', function ($item) {
                    return '
                        <div class="btn-group">
                            <div class="dropdown-center">

                                <button class="btn btn-primary dropdown-toggle" mr-1 mb-1 type="button" data-bs-toggle="dropdown" aria-expanded="false id="action' .  $item->id . '">
                                    Aksi
                                </button>

                                
                                <div class="dropdown-menu"' .  $item->id . '">
                                    <a class="dropdown-item" href="' . route('product.edit', $item->id) . '">
                                        Sunting
                                    </a>
                                    <form action="' . route('product.destroy', $item->id) . '" method="POST">
                                        ' . method_field('delete') . csrf_field() . '
                                        <button type="submit" class="dropdown-item text-danger">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </div>
                    </div>';
                })
                ->rawColumns(['action'])
                ->make();
                
                
        }
        
        return view('pages.admin.product.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //ini untuk memanggil semua data user
        $users = User::all();
        $categories = Category::all();

        

        return view('pages.admin.product.create', [
            'users' => $users,
            'categories' => $categories,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        // data itu variabel baru
        // ambil semua product request dan masukan ke dalam variabel data
         $data = $request->all();

        $data['slug'] = Str::slug($request->name);

        Product::create($data);

        return redirect()->route('product.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = Product::findOrFail($id);

        $users = User::all();
        $categories = Category::all();

        return view('pages.admin.product.edit', [
            'item' => $item,
            'users' => $users,
            'categories' => $categories,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $id)
    {
        $data = $request->all();

        

        $item = Product::findOrFail($id);

        $data['slug'] = str::slug($request->name);

        $item->update($data);

        return redirect()->route('product.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Product::findOrFail($id);

        $item->delete();

        return redirect()->route('product.index');
    }
}
