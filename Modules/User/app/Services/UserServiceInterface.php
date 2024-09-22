<?php

namespace Modules\User\Services;

use Illuminate\Http\Request;

interface UserServiceInterface
{
    public function get_all(Request $request);
}
