<?php

namespace Modules\Payment\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Payment\Database\Factories\CouponUsesFactory;

class Coupon_uses extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $table = 'discounts';

    protected $fillable = [
        'coupon_id',
        'user_id',
        'discount_value',
        'used_at',
    ];
    
    public function coupons()
    {
        return $this->belongsTo(Coupons::class);
    }

    public function users()
    {
        return $this->belongsTo(User::class);
    }
}
