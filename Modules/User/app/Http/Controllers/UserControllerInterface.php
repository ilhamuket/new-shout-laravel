<?php

namespace Modules\User\Http\Controllers;

use Illuminate\Http\Request;

interface UserControllerInterface {
    public function index(Request $request);
}
