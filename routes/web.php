<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use Inertia\Inertia;

Route::get('/info', function () {
    return phpinfo();
});

Route::get('/', function () {
    return Inertia::render('Event/Show');
});

Route::inertia('/about', 'About');



Route::prefix('auth')->group(function () {
    Route::post('/register', [AuthController::class, 'authRegister']);
    Route::get('/login', [AuthController::class, 'authLogin'])->name('login');

    Route::get('/me', [AuthController::class, 'authGetMe'])->middleware(['auth:sanctum']);
});
