<?php

namespace Modules\User\Services;

use Modules\User\Repositories\UserRepositoryInterface;

class UserService implements UserServiceInterface
{
    protected $user_repo;
    public function __construct(UserRepositoryInterface $user_repo) {
        $this->user_repo = $user_repo;
    }

    public function get_all(array $payload)
    {
        return $this->user_repo->get_data($payload);
    }
}
