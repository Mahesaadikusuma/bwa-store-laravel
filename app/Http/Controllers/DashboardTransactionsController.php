<?php

namespace App\Http\Controllers;

use App\TransactionDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardTransactionsController extends Controller
{
    public function index() 
    {
        $sellTransactions = TransactionDetail::with(['transaction.user','product.galleries'])
            
            ->whereHas('product', function($product){
                $product->where('users_id', Auth::user()->id);
            })->paginate(5); // ini aslinya get bukan paginate 

        $buyTransactions = TransactionDetail::with(['transaction.user','product.galleries'])
            
            ->whereHas('transaction', function($transaction){
                $transaction->where('users_id', Auth::user()->id);
            })->paginate(5); // ini aslinya get bukan paginate 
            
        return view('pages.dashboard-transactions', [
            'sellTransactions' => $sellTransactions,
            'buyTransactions' => $buyTransactions
        ]);
    }

    public function details(Request $request, $id) 
    {

        $transaction = TransactionDetail::with(['transaction.user','product.galleries'])
            ->findOrFail($id);


        return view('pages.dashboard-transactions-detail',[
            'transaction' => $transaction,
        ]);
    }


    public function update(Request $request, $id) {
        $data = $request->all();

        $item = TransactionDetail::findOrfail($id);
        $item->update($data);

        return redirect()->route('dashboard-transactions-details', $id);
    }
}
