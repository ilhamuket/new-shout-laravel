<?php

namespace Modules\Seller\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Modules\Product\Models\Product;

class Seller extends Model
{
    protected $table = 'sellers';

    protected $fillable = [
        'user_id',
        'store_name',
        'description',
        'store_address',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->hasMany(Product::class);
    }
}
