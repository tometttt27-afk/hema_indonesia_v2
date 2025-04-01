<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductsModel extends Model
{
    protected $table = 'products';
    protected $fillable = [
        'name',
        'code_product',
        'description',
        'price',
        'discount',
        'stock',
        'category_id',
        'size',
        'image',
        'is_active'
    ];

    public function categories()
    {
        return $this->belongsTo(CategoriesModel::class, 'category_id', 'id');
    }
}