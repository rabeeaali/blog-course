<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\TagController;
use App\Http\Controllers\Backend\HomeController;
use App\Http\Controllers\Backend\PostController;
use App\Http\Controllers\Backend\UserController;

Route::middleware('admin')->prefix('admin')->name('admin.')->group(function () {

    Route::get('/',[HomeController::class,'index'])->name('home');

    Route::resource('users', UserController::class);

    Route::resource('posts', PostController::class);

    Route::resource('tags', TagController::class);

});