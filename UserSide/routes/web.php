<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminSideController;
use App\Http\Controllers\UserSideController;


Route::get('/', [UserSideController::class, 'home']);
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/admin', [AdminSideController::class, 'home']);
});
