<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WishlistModel extends Model
{
    protected $table = 'wishlist';
    protected $fillable = [
        'user_id',
        'product_id',
    ];

    public function product()
    {
        return $this->belongsTo(ProductsModel::class, 'product_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
