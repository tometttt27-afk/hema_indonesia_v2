<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
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
        'final_price',
        'stock',
        'category_id',
        'size',
        'image',
        'is_active',
    ];

    /* ──────────────────────────────────────────────────────────
     | CASTS — otomatis konversi tipe saat baca/tulis DB
     |──────────────────────────────────────────────────────────*/
    protected $casts = [
        'price'       => 'float',
        'discount'    => 'float',
        'final_price' => 'float',
        'stock'       => 'integer',
        'is_active'   => 'integer',
    ];

    /* ──────────────────────────────────────────────────────────
     | ACCESSORS
     |──────────────────────────────────────────────────────────*/

    /**
     * Harga akhir setelah diskon.
     * Digunakan di blade & controller tanpa perlu hitung manual.
     * Jika kolom final_price sudah ada di DB, accessor ini
     * akan menjadi fallback jika nilainya 0 / null.
     */
    public function getFinalPriceAttribute($value): float
    {
        if ($value && (float) $value > 0) {
            return (float) $value;
        }
        $price    = (float) ($this->attributes['price']    ?? 0);
        $discount = (float) ($this->attributes['discount'] ?? 0);
        return $price - ($price * $discount / 100);
    }

    /**
     * Array ukuran dari string CSV ("s, m, l" → ['s','m','l']).
     * Dipakai di blade agar tidak perlu explode() manual.
     */
    public function getSizesArrayAttribute(): array
    {
        if (empty($this->size)) {
            return [];
        }
        return array_values(array_filter(
            array_map('trim', explode(',', $this->size))
        ));
    }

    /**
     * Apakah stok habis?
     */
    public function getIsOutOfStockAttribute(): bool
    {
        return !is_null($this->stock) && (int) $this->stock <= 0;
    }

    /**
     * Apakah stok menipis (1–5)?
     */
    public function getIsLowStockAttribute(): bool
    {
        return !is_null($this->stock)
            && (int) $this->stock > 0
            && (int) $this->stock <= 5;
    }

    /**
     * URL gambar produk — selalu return string lengkap.
     * Blade cukup tulis: {{ $product->image_url }}
     */
    public function getImageUrlAttribute(): string
    {
        return asset('uploads/products/' . ($this->image ?? 'default.jpg'));
    }

    /* ──────────────────────────────────────────────────────────
     | LOCAL SCOPES
     |──────────────────────────────────────────────────────────*/

    /** Hanya produk aktif (is_active = 1) */
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', 1);
    }

    /** Hanya produk dengan stok tersedia */
    public function scopeInStock(Builder $query): Builder
    {
        return $query->where(function (Builder $q) {
            $q->whereNull('stock')->orWhere('stock', '>', 0);
        });
    }

    /** Hanya produk yang sedang diskon */
    public function scopeOnSale(Builder $query): Builder
    {
        return $query->where('discount', '>', 0);
    }

    /** Urutkan terbaru */
    public function scopeLatestFirst(Builder $query): Builder
    {
        return $query->orderBy('created_at', 'desc');
    }

    /* ──────────────────────────────────────────────────────────
     | RELATIONS
     |──────────────────────────────────────────────────────────*/

    public function categories()
    {
        return $this->belongsTo(CategoriesModel::class, 'category_id', 'id');
    }

    public function wishlists()
    {
        return $this->hasMany(WishlistModel::class, 'product_id', 'id');
    }

    public function orderDetails()
    {
        return $this->hasMany(DetailOrderModel::class, 'product_id', 'id');
    }
}
