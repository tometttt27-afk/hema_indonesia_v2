<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductModel extends Model
{
    protected $table = 'product';
    protected $fillable = [
        'name',
        'description',
        'price',
        'diskon',
        'stok',
        'category_id',
        'size',
        'image'
    ];
}
