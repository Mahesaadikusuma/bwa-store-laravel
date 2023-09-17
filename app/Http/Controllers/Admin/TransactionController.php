<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Category;
use App\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;

class TransactionController extends Controller
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
            // ini untuk memanggil model transaction dengan relasi user dan category 
            // jadi di dalam model transaction memanggil model user dan juga category]
            //->withTrashed() itu untuk memanggil data yang telah dihapus pakai soft delete 
            // jika ada softdelet datanya akan dihapus tetapi di database tidak dihapus dan 
            // ->withTrashed() itu memanggil data yang dihapus
            $query = Transaction::with(['user']);
            
             return Datatables::of($query)
                ->addColumn('action', function ($item) {
                    return '
                        <div class="btn-group">
                            <div class="dropdown-center">

                                <button class="btn btn-primary dropdown-toggle" mr-1 mb-1 type="button" data-bs-toggle="dropdown" aria-expanded="false id="action' .  $item->id . '">
                                    Aksi
                                </button>

                                
                                <div class="dropdown-menu"' .  $item->id . '">
                                    <a class="dropdown-item" href="' . route('transaction.edit', $item->id) . '">
                                        Sunting
                                    </a>
                                    <form action="' . route('transaction.destroy', $item->id) . '" method="POST">
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
        
        return view('pages.admin.transaction.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        $item = Transaction::findOrFail($id);
        return view('pages.admin.transaction.edit', [
            'item' => $item,
            
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();
        $item = Transaction::findOrFail($id);
        $item->update($data);

        return redirect()->route('transaction.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Transaction::findOrFail($id);

        $item->delete();

        return redirect()->route('transaction.index');
    }
}
