<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ForgotPasswordController;
use Illuminate\Support\Collection;

Route::get('/', function () {
    return view('welcome');
});

