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
        $entities = $request->entities;
        $since = $request->since;
        $until = $request->until;
        $limit = $request->input('limit', 5);

        if ($since && $until) {
            $since_to_utc = (string) Helper::local_time_to_utc($since, self::TIME_ZONE, true);
            $until_to_utc = (string) Helper::local_time_to_utc($until, self::TIME_ZONE, true);

            $since_utc_to_timestamp = Helper::utc_time_to_timestamp($since_to_utc, false);
            $until_utc_to_timestamp = Helper::utc_time_to_timestamp($until_to_utc, false);
        }

        $payload = [
            'entities' => $entities,
            'since' => $since_utc_to_timestamp,
            'until' => $until_utc_to_timestamp,
            'limit' => $limit,
        ];
        return $this->user_repo->get_data($payload);
    }
}
