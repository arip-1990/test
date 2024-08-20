<?php

use App\Http\Controllers\Auth;
use App\Http\Controllers\Directory;
use App\Http\Controllers\File;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->group(function () {
    Route::post('/register', Auth\RegisterController::class);
    Route::post('/login', Auth\LoginController::class);
    Route::post('/logout', Auth\LogoutController::class)->middleware('auth:sanctum');
});

Route::middleware('auth:sanctum')->group(function () {
    Route::prefix('dir')->group(function () {
        Route::post('/', Directory\CreateController::class);
        Route::put('/', Directory\RenameController::class);
        Route::delete('/', Directory\DeleteController::class);
    });

    Route::prefix('file')->group(function () {
        Route::get('/{directory?}', File\IndexController::class);
        Route::post('/{directory?}', File\UploadController::class);
        Route::put('/', File\RenameController::class);
        Route::delete('/', File\DeleteController::class);
    });
});
