<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\PhotoBoothController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\ContactMessageController;
use App\Http\Controllers\StickerController;
use App\Http\Controllers\GoogleController;


Route::get('/', function () {
    return view('user.index');
})->name('home');

Route::get('/about', function () {
    return view('user.about');
});

Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');


Route::get('/photo', function () {
    return view('user.photo');
});

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/signup', [AuthController::class, 'showSignup'])->name('signup');
Route::post('/signup', [AuthController::class, 'signup'])->name('signup.post');

Route::get('/layout', [PhotoBoothController::class, 'showLayout'])->name('photobooth.layout');
Route::get('/camera', [PhotoBoothController::class, 'showCamera'])->name('photobooth.camera');
Route::get('/sticker', [PhotoBoothController::class, 'showSticker'])->name('photobooth.sticker');
Route::get('/photo', [PhotoBoothController::class, 'showPhoto'])->name('photobooth.photo');

Route::view('/profile/settings', 'user.profile')
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

Route::get('/admin/stickers', [StickerController::class, 'index'])
    ->name('admin.stickers.index');

Route::post('/admin/stickers', [StickerController::class, 'store'])
    ->name('admin.stickers.store');

Route::delete('/admin/stickers/{id}', [StickerController::class, 'destroy'])
    ->name('admin.stickers.destroy');

    //Google
Route::get('/auth/google', [GoogleController::class, 'redirect'])->name('google.login');
Route::get('/auth/google-callback', [GoogleController::class, 'callback']);