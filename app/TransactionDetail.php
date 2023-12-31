<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransactionDetail extends Model
{
    protected $fillable = [
        'transaction_id',
        'product_id',
        'price', 
        'shipping_status', 
        'resi', 
        'code'
    ];

    protected $hidden = [

    ];

    public function product() {
        return $this->hasOne(Product::class, 'id', 'product_id');
    }

    public function transaction() {
        return $this->hasOne(Transaction::class, 'id', 'transaction_id');
    }
}
