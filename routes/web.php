<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PhotoBoothController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\ContactMessageController;


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

Route::get('/layout', [PhotoBoothController::class, 'showLayout'])->name('photobooth.layout');
Route::get('/camera', [PhotoBoothController::class, 'showCamera'])->name('photobooth.camera');
Route::get('/sticker', [PhotoBoothController::class, 'showSticker'])->name('photobooth.sticker');
Route::get('/photo', [PhotoBoothController::class, 'showPhoto'])->name('photobooth.photo');

Route::view('/profile/settings', 'contact.profile')
    ->name('profile.settings');
Route::get('/profile/settings', [ProfileController::class, 'edit'])->name('profile.settings');
Route::post('/profile/settings', [ProfileController::class, 'update'])->name('profile.update');

//admin routes

Route::middleware(['auth'])->group(function () {

    Route::get('/admin', [AdminController::class, 'index'])
        ->name('admin.index');

    Route::post('/admin/users', [AdminController::class, 'store'])
        ->name('admin.users.store');

    Route::delete('/admin/users/{user}', [AdminController::class, 'destroy'])
        ->name('admin.users.destroy');
});


Route::prefix('admin')->name('admin.')->group(function () {

    // list page
    Route::get('/contact', [ContactMessageController::class, 'index'])
        ->name('contact.index');

    // delete message
    Route::delete('/contact/{id}', [ContactMessageController::class, 'destroy'])
        ->name('contact.delete');
});