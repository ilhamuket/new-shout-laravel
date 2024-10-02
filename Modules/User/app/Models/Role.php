<?php

namespace Modules\User\Models;

use App\Helpers\Helper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\User\Database\Factories\RoleFactory;

class Role extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [];

    protected static function newFactory(): RoleFactory
    {
        //return RoleFactory::new();
    }


    public function scopeEntitites($query, $entities) {
        return Helper::entities($query, $entities);
    }

    public function permissions() {
        return $this->belongsToMany(Permission::class, 'role_has_permissions', 'permission_id', 'role_id');
    }
}
