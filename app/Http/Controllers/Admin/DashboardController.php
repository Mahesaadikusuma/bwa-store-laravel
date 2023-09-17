<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Transaction;

class DashboardController extends Controller
{
    public function index() {
        $customer = User::count();
        $Revenue = Transaction::where('transaction_status', 'SUCCESS')->sum('total_price');
        $Transaction = Transaction::count();

        return view('pages.admin.dashboard', [
            'customer' => $customer,
            'Revenue' => $Revenue,
            'Transaction' => $Transaction
        ]);
    }
}
