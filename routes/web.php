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



