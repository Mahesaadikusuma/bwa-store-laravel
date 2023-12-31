<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Category extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name','photo','slug'
    ];

    protected $hidden = [

    ];

    public function product()
    {
        return $this->hasMany(product::class, 'categories_id', 'id');
    }
}
