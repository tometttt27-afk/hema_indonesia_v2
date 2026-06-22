<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailOrderModel extends Model
{
    protected $table = 'detail_orders';
    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
        'price',
        'size',
    ];

    public function order()
    {
        return $this->belongsTo(OrderModel::class, 'order_id', 'id');
    }

    public function product()
    {
        return $this->belongsTo(ProductsModel::class, 'product_id', 'id');
    }
}
