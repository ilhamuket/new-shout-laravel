<?php

use Illuminate\Support\Facades\Route;
use Modules\General\Http\Controllers\GeneralController;
use Modules\General\Http\Controllers\CloudController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group([], function () {
    Route::resource('general', GeneralController::class)->names('general');
    Route::post('upload', [CloudController::class, 'upload'])->name('general.upload');
});
