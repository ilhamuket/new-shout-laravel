<?php

namespace Modules\Payment\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Payment\Database\Factories\CouponsFactory;

class Coupons extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $table = 'discounts';

    protected $fillable = [
        'code',
        'description',
        'discount_value',
        'expiry_date',
    ];

    public function CouponsUses()
    {
        return $this->hasMany(Coupon_Uses::class);
    }
    
}
