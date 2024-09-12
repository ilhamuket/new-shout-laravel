<?php

namespace Modules\Payment\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Payment\Database\Factories\DiscountsFactory;

class Discounts extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $table = 'discounts';

    protected $fillable = [
        'code',
        'description',
        'discount_amount',
        'start_date',
        'end_date',
    ];
}
