<?php

namespace Modules\User\Services;

use Modules\User\Repositories\RoleRepositoryInterface;

class RoleService implements RoleServiceInterface
{
    public function __construct(RoleRepositoryInterface $role_repo) {
        $this->role_repo = $role_repo;
    }

    /**
     * Bussines Logic to get from role repository
     */
    public function get_all(array $payloads) {
        return $this->role_repo->get_all($payloads);
    }
}
