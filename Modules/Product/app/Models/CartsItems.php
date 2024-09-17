<?php

namespace Modules\Product\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Product\Database\Factories\CartsItemsFactory;

class Carts_items extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $table = ['cart_items'];

    protected $fillable = [
        'cart_id',
        'product_id',
        'quantity',
    ];

    public function carts()
    {
        return $this->belongsTo(Carts::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
