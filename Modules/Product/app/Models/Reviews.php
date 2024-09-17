<?php

namespace Modules\Product\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Product\Database\Factories\ReviewsFactory;

class Reviews extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $table = ['reviews'];

    protected $fillable = [
        'product_id',
        'user_id',
        'rating',
        'comment',
    ];

    public function products()
    {
        return $this->belongsTo(Product::class);
    }

    public function users()
    {
        return $this->belongsTo(User::class);
    }
}
