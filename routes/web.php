<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\AuthWebController;
use App\Http\Controllers\Web\AboutWebController;

use Inertia\Inertia;

Route::get('/info', function () {
    return phpinfo();
});
Route::post('/auth/login', [AuthWebController::class, 'authWebLogin'])->name('web-login');
Route::post('/auth/register', [AuthWebController::class, 'authRegister']);
Route::post('/login', [AuthWebController::class, 'authWebLogin']);
Route::get('/login', [AuthWebController::class, 'authWebLoginGet']);

Route::get('/loginout', [AuthWebController::class, 'authWebLoginOut'])->middleware('auth:sanctum');

Route::inertia('/', 'AppStartPage');

Route::get('/about',  [AboutWebController::class,'index'])->middleware('auth:sanctum');



//Route::inertia('/login', 'LoginPage');


Route::inertia('/register', 'RegistrationPage');



