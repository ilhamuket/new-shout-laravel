<?php

namespace Modules\User\Repositories;

use App\Models\User;

class UserRepository implements UserRepositoryInterface
{
    public function get_data(array $payload)
    {
        $user = User::entities($payload['entities'])->paginate($payload['limit']);

        return $user;
    }
}
