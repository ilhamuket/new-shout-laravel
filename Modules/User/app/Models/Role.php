<?php

namespace Modules\User\Models;

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

    public function permissions() {
        return $this->belongsToMany(Permission::class, 'role_has_permissions', 'permission_id', 'role_id');
    }
}
