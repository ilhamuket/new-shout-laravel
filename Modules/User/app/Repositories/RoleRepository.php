<?php

namespace Modules\User\Repositories;

class RoleRepository implements RoleRepositoryInterface
{
    /**
     * Get All Data Roles From Databases
     */
    public function get_all(array $attributes) {
        $role = Role::entities($attributes['entities'])
            ->paginate($attributes['limit']);

        return $role;
    }
}
