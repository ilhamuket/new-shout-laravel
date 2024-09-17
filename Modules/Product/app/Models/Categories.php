<?php

namespace Modules\Product\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Product\Database\Factories\CategoriesFactory;

class Categories extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $table = ['categories'];

    protected $fillable = [
        'name',
        'parent_id',
    ];

    public function parent()
    {
        return $this->belongsTo(Categories::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Categories::class, 'parent_id');
    }
}
