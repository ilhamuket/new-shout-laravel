<?php

namespace Modules\Product\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Product\Database\Factories\ProductSearchLogsFactory;

class Product_search_logs extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $table = ['product_search_logs'];

    protected $fillable = [
        'user_id',
        'search_query',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
