<?php

namespace Modules\Product\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Payment\Models\Discounts;
use Modules\Product\Database\Factories\ProductDiscountsFactory;

class Product_discounts extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $table = ['product_discounts'];

    protected $fillable = [
        'product_id',
        'discount_id',
    ];

    public function products()
    {
        return $this->belongsTo(Product::class);
    }

    public function seller()
    {
        return $this->belongsTo(Discounts::class);
    }
}
