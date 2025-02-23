<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/login', function () {
    return view('credential.login', ['title' => 'Login']);

})->name('login');
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');

Route::post('/check-email', [RegisterController::class, 'checkEmail'])->name('check.email');

Route::post('/register', [RegisterController::class, 'register'])->name('register.submit');
