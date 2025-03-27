<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\CounteragentController;
use App\Http\Controllers\AuthController;


Route::get('/', [ApiController::class,'apiIndex']);


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/register', [AuthController::class, 'authRegister'])->name('register');


Route::post('/login', [AuthController::class, 'authLogin'])->name('login');
Route::get('/me', [AuthController::class, 'authGetMe'])->middleware(['auth:sanctum']);



// Группируем маршруты, требующие авторизации
Route::middleware('auth:sanctum')->group(function () {
    Route::post('counteragents', [CounteragentController::class, 'store']);
    Route::get('counteragents', [CounteragentController::class, 'index']);
});
