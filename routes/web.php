<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\AuthWebController;
use App\Http\Controllers\Web\AboutWebController;
use App\Http\Controllers\Web\CounteragentWebController;

use Inertia\Inertia;

Route::get('/', [AuthWebController::class, 'appStartPage'])->middleware('auth:sanctum');
Route::post('/', [AuthWebController::class, 'appStartPage'])->middleware('auth:sanctum');

Route::post('/auth/login', [AuthWebController::class, 'authWebLogin'])->name('web-login');

Route::post('/login', [AuthWebController::class, 'authWebLogin'])->name('login');
Route::get('/login', [AuthWebController::class, 'authWebLoginGet'])->middleware('api');;


Route::get('/auth/register', [AuthWebController::class, 'authRegisterGet']);
Route::post('/auth/register', [AuthWebController::class, 'authRegister']);
Route::get('/loginout', [AuthWebController::class, 'authWebLoginOut'])->middleware('auth:sanctum');
Route::get('/about',  [AboutWebController::class,'index'])->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->prefix('counteragents')->group(function () {
    Route::get('/', [CounteragentWebController::class,'list'])->name('counteragents-list');

    Route::post('/add/inn', [CounteragentWebController::class,'addInn']);
    Route::get('/add/inn', [CounteragentWebController::class,'list']);
});

Route::get('/info', function () {
    return phpinfo();
})->middleware('auth:sanctum');









