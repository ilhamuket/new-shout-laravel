<?php

namespace Modules\Product\Models;

use Modules\Seller\Models\Seller;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Product\Database\Factories\ProductFactory;

class Product extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $table = ['products'];

    protected $fillable = [
        'name',
        'description',
        'price',
        'stock',
        'category_id',
        'seller_id',
    ];

    public function category()
    {
        return $this->belongsTo(Categories::class);
    }

    public function seller()
    {
        return $this->belongsTo(Seller::class);
    }

    // public function pruduct_images()
    // {
    //     return $this->hasMany(Product_images::class);
    // }
}
