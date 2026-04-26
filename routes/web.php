<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VehicleController;
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
Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::get('/driver_view', [UserController::class, 'showDriver'])->name('users.driverView');

//vehicle routes
Route::get('/vehicles/inactive',[VehicleController::class, 'inactive'])->name('vehicles.inactive');
Route::patch('/vehicles/{id}/restore',[VehicleController::class, 'restore'])->name('vehicles.restore');
Route::resource('vehicles',VehicleController::class);
