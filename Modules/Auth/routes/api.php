<?php

use App\Http\Middleware\AdminGuardMiddleware;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Support\Facades\Route;
use Modules\Auth\Http\Controllers\AuthController;

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


Route::group([
    'prefix' => 'v1',
], function () {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
});


Route::group([
    'prefix' => 'v1',
    'middleware' => ['auth:api'],
], function () {
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    // Route::middleware([AdminGuardMiddleware::class.':admin'])->get('user-get', [AuthController::class, 'userGet']);
    Route::get('user-get', [AuthController::class, 'userGet']);
    Route::post('password/reset', [AuthController::class, 'resetPassword']);
    Route::post('password/update', [AuthController::class, 'updatePassword']);
});
