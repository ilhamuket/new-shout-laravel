<?php

use Illuminate\Support\Facades\Route;
use Modules\General\Http\Controllers\GeneralController;
use Modules\General\Http\Controllers\CloudController;
use Modules\General\Http\Controllers\ShipmentController;



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

Route::prefix('/shipment')->group(function () {
    Route::get('/', [ShipmentController::class, 'index']);
    Route::get('/provinces', [ShipmentController::class, 'getProvinces']);
    Route::get('/cities', [ShipmentController::class, 'getCitiesByProvince']);
    Route::get('/subdistricts', [ShipmentController::class, 'getSubdistrictsByCity']);
    Route::post('/shipping-cost', [ShipmentController::class, 'getShippingCost']);
    Route::get('/couriers', [ShipmentController::class, 'getCouriers']);
});
