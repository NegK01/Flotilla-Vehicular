<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('login');
})->name("index");

Route::get('/SignIn', function () {
    return view('SignIn.signin');
})->name("SignIn");
