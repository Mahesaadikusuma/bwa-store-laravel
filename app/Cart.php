<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = [
        'products_id', 'users_id'
    ];

    protected $hidden = [

    ];

    public function product()
    {
        return $this->hasOne(product::class, 'id', 'products_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id', 'id');
    }
}
