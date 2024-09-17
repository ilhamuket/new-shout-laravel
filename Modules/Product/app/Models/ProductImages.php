<?php

namespace Modules\Product\Models;

use Modules\Product\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Product\Database\Factories\ProductImagesFactory;

class Product_images extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $table = ['product_images'];

    protected $fillable = [
        'product_id',
        'image_url',
    ];

    public function products()
    {
        return $this->belongsTo(Product::class);
    }
}
