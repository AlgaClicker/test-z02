<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Web\AuthWebController;
use Inertia\Inertia;

Route::get('/info', function () {
    return phpinfo();
});

Route::get('/', function () {
    return Inertia::render('AppStartPage');
});

//Route::inertia('/about', 'About');

Route::get('/about', [AuthWebController::class,'about']);
Route::inertia('/register', 'RegisterPage');

Route::inertia('/login', 'LoginPage');
Route::post('/login', [AuthWebController::class,'login']);

