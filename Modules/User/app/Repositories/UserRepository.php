<?php

namespace Modules\User\Repositories;

use App\Models\User;

class UserRepository implements UserRepositoryInterface
{
    public function get_data(array $attributes)
    {
        $user = User::entities($attributes['entities'])
            ->filterByDateRange('created_at', $attributes['since'], $attributes['until'])
            ->paginate($attributes['limit']);

        return $user;
    }
}
