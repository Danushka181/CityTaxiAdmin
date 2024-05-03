<?php

use App\Http\Controllers\Api\PassengerController;
use App\Http\Controllers\Drivers\DriverManageController;
use App\Http\Controllers\Mail\MailController;
use App\Http\Controllers\Passengers\PassengerManageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Trips\TripsManageController;
use App\Http\Controllers\Vehicle\VehicleController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    $totalDrivers = DriverManageController::getTotalDrivers();
    $totalPassengers = PassengerManageController::getTotalPassengers();
    $totalTrips = TripsManageController::getTotalTrips();
    $totalVehicles = VehicleController::getTotalVehicles();
    $totalRevenue = TripsManageController::getTotalRevenue();
    $totalTripsToday = TripsManageController::getTotalTripsToday();
    $totalTripsThisMonth = TripsManageController::getTotalTripsThisMonth();

    return Inertia::render('Dashboard', [
        'totalDrivers' => $totalDrivers,
        'totalPassengers' => $totalPassengers,
        'totalTrips' => $totalTrips,
        'totalVehicles' => $totalVehicles,
        'totalRevenue' => $totalRevenue,
        'totalTripsToday' => $totalTripsToday,
        'totalTripsThisMonth' => $totalTripsThisMonth,
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('drivers', DriverManageController::class);
    Route::resource('passenger', PassengerManageController::class);
    Route::resource('trips', TripsManageController::class);
    Route::resource('vehicle', VehicleController::class);



});


require __DIR__.'/auth.php';
