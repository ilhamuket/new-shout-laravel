<?php

namespace Modules\User\Services;

use App\Helpers\Helper;
use Modules\User\Repositories\UserRepositoryInterface;
use Illuminate\Http\Request;

class UserService implements UserServiceInterface
{
    protected $user_repo;
    const TIME_ZONE = 'Asia/Jakarta';
    public function __construct(UserRepositoryInterface $user_repo)
    {
        $this->user_repo = $user_repo;
    }

    public function get_all(Request $request)
    {
        $now = now();
        $before_month = now()->subDays(30);
        $entities = $request->entities;
        $until = $request->until;
        $since = $request->since;
        $limit = $request->input('limit', 5);

        if (is_null($since) && is_null($until)) {
            $since = $before_month;
            $until = $now;

            $since_format = Helper::utc_to_local_time($since, self::TIME_ZONE);
            $until_format = Helper::utc_to_local_time($until, self::TIME_ZONE);
        } else {
            $since_format = "$since 00:00:00";
            $until_format = "$until 23:59:59";
        }
        $payload = [
            'entities' => $entities,
            'since' => $since_format ?? null,
            'until' => $until_format ?? null,
            'limit' => $limit,
        ];

        return $this->user_repo->get_data($payload);
    }
}
