<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\CounteragentController;



Route::get('/', [ApiController::class,'apiIndex']);


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


// Группируем маршруты, требующие авторизации
Route::middleware('auth:sanctum')->group(function () {
    Route::post('counteragents', [CounteragentController::class, 'store']);
    Route::get('counteragents', [CounteragentController::class, 'index']);
});
