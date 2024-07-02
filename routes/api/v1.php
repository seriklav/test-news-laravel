<?php

use App\Http\Controllers\News\IndexController;
use App\Http\Controllers\News\StoreController;
use App\Http\Controllers\News\ShowController;
use App\Http\Controllers\News\UpdateController;
use App\Http\Controllers\News\DeleteController;
use Illuminate\Support\Facades\Route;


Route::prefix('news')->group(function () {
    Route::get('', IndexController::class);
    Route::post('', StoreController::class);

    Route::prefix('{news}')->group(function () {
        Route::get('', ShowController::class);
        Route::patch('', UpdateController::class);
        Route::delete('', DeleteController::class);
    });
});
