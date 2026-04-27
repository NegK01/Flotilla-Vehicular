<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\OperadorController;
use App\Http\Controllers\VehicleRequestsController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/register', function () {
    return view('SignIn.signin');
})->name('register');






//login routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.store');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

//Register routes
Route::post('users/store', [AuthController::class, 'store'])->name('user.store');


//user routes
Route::resource('users', UserController::class)
    ->where(['user' => '[0-9]+']);
Route::get('users/inactive', [UserController::class, 'inactive'])->name('users.inactive');
Route::patch('users/{user}/restore', [UserController::class, 'restore'])->name('users.restore');


Route::get('/driver_view', [UserController::class, 'showDriver'])->name('users.driverView');

//vehicle routes
Route::get('/vehicles/inactive', [VehicleController::class, 'inactive'])->name('vehicles.inactive');
Route::patch('/vehicles/{id}/restore', [VehicleController::class, 'restore'])->name('vehicles.restore');

Route::resource('vehicles', VehicleController::class);

Route::post('/directStore', [VehicleRequestsController::class, 'directStore'])->name('request.directstore');

Route::get('/historial', [DriverController::class, 'requestHistorial'])->name('request.historial');

Route::post('/historial', [DriverController::class, 'historial'])->name('driver.historial');
Route::resource('driver', DriverController::class);


//vehicle requests routes
Route::resource('vehicle-requests', VehicleRequestsController::class);
Route::patch('/vehicles/{id}/aprove', [VehicleRequestsController::class, 'aprove'])->name('vehicles-request.aprove');
Route::patch('/vehicles/{id}/reject', [VehicleRequestsController::class, 'reject'])->name('vehicles-request.reject');

//Operador routes
Route::resource('operador', OperadorController::class);
