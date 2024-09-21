<?php

use App\Http\Middleware\AdminGuardMiddleware;
use Illuminate\Support\Facades\Route;
use Modules\User\Http\Controllers\UserController;

/*
 *--------------------------------------------------------------------------
 * API Routes
 *--------------------------------------------------------------------------
 *
 * Here is where you can register API routes for your application. These
 * routes are loaded by the RouteServiceProvider within a group which
 * is assigned the "api" middleware group. Enjoy building your API!
 *
*/

Route::middleware(['auth:api', AdminGuardMiddleware::class.':admin'])->prefix('user')->group(function () {

    Route::get('/', [UserController::class, 'index']);
});
