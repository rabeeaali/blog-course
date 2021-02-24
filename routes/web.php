<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\FacebookAuthController;
use App\Http\Controllers\Frontend\HomeController;

require __DIR__ . '/auth.php';


Route::get('/', [HomeController::class, 'index']);
Route::get('post/{post}', [HomeController::class, 'show'])->name('frontend.post.show');

Route::get('auth/redirect', [FacebookAuthController::class, 'redirect'])->name('facebook.redirect');
Route::get('auth/callback', [FacebookAuthController::class, 'callback'])->name('facebook.callback');

//backend
require __DIR__ . '/admin.php';
