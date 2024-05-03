<?php

use App\Http\Controllers\Api\DriverController;
use App\Http\Controllers\Api\OtpController;
use App\Http\Controllers\Api\PassengerController;
use App\Http\Controllers\Api\RegisterController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Api Login routes

Route::middleware(['api'])->prefix('auth')->group(function () {
    Route::post('register/otp', [OtpController::class, 'loginWithOTP']);
    Route::post('register/otp-verify', [OtpController::class, 'verifyWithOTP']);
    Route::post('register/otp-resend', [OtpController::class, 'resendOTP']);
});

Route::middleware(['api','otp.setup'])->prefix('driver')->group(function () {
   Route::post('register', [DriverController::class,'driverRegister']);
});

// All routes for passengers
Route::middleware(['api','otp.setup'])->prefix('passenger')->group(function () {
   Route::post('register', [PassengerController::class,'passengerRegister']);
});

Route::group([
    'middleware' => 'api',
    'prefix' => 'passenger'
], function ($router) {
    Route::post('login', [PassengerController::class,'passengerLogin']);
    Route::post('logout', [PassengerController::class,'logout']);
    Route::post('refresh', [PassengerController::class,'refresh']);
    Route::post('me', [PassengerController::class,'me']);

});


// All routes for drivers
Route::group([
    'middleware' => 'api',
    'prefix' => 'drivers'
], function ($router) {
    Route::post('login', [DriverController::class,'driverLogin']);
    Route::post('logout', [DriverController::class,'passengerLogin']);
    Route::post('refresh', [DriverController::class,'refresh']);
    Route::post('me', [DriverController::class,'me']);
});




