<?php

use App\Http\Controllers\DriverController;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\VehicleController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//------------------------------------------------------------------------------------------------------------------------------
//  Vehicle
//------------------------------------------------------------------------------------------------------------------------------

Route::get('/index-vehicle', [VehicleController::class, 'index']);
Route::get('/params-vehicles', [VehicleController::class, 'params']);
Route::post('/store-vehicle', [VehicleController::class, 'store']);
Route::put('/update-vehicle/{vehicle}', [VehicleController::class, 'update']);

//------------------------------------------------------------------------------------------------------------------------------
//  Owner
//------------------------------------------------------------------------------------------------------------------------------

Route::get('/index-owner', [OwnerController::class, 'index']);
Route::post('/store-owner', [OwnerController::class, 'store']);
Route::put('/update-owner/{owner}', [OwnerController::class, 'update']);

//------------------------------------------------------------------------------------------------------------------------------
//  Driver
//------------------------------------------------------------------------------------------------------------------------------

Route::get('/index-driver', [DriverController::class, 'index']);
Route::post('/store-driver', [DriverController::class, 'store']);
Route::put('/update-driver/{driver}', [DriverController::class, 'update']);

//------------------------------------------------------------------------------------------------------------------------------
//  Report
//------------------------------------------------------------------------------------------------------------------------------

Route::get('/report-vehicles', [VehicleController::class, 'report']);
