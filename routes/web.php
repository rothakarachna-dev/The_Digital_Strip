<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('contact.index');
});

Route::get('/about', function () {
    return view('contact.about');
});

Route::get('/contact', function () {
    return view('contact.contact');
});

Route::get('/photo', function () {
    return view('contact.photo');
});

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/signup', [AuthController::class, 'showSignup']);

Route::post('/signup', [AuthController::class, 'signup']);

Route::get('/auth/google', [AuthController::class, 'redirectToGoogle']);

Route::get('/auth/google/callback', [AuthController::class, 'handleGoogleCallback']);