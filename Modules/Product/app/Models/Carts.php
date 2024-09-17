<?php

namespace Modules\Product\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Product\Database\Factories\CartsFactory;

class Carts extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $table = ['carts'];

    protected $fillable = [
        'user_id',
    ];

    // public function user()
    // {
    //     return $this->belongsTo(User::class);
    // }
}
