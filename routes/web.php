<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
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
Route::get('/users/update/{user}', [UserController::class, 'show'])->name('users.edit'); //show
Route::put('/users/update/{user}', [UserController::class, 'update'])->name('users.update'); //update





Route::get('/driver_view', [UserController::class, 'showDriver'])->name('users.driverView');
