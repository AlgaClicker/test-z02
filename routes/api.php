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

Route::post('/register', [AuthController::class, 'authRegister'])->name('register')->middleware(['api']);
Route::post('/login', [AuthController::class, 'authLogin'])->name('login');

// Группируем маршруты, требующие авторизации
Route::middleware('auth:sanctum')->group(callback: function () {
    Route::post('counteragent/add/inn', [CounteragentController::class, 'create']);
    Route::get('counteragent/{id}/', [CounteragentController::class, 'get']);
    Route::get('counteragents', [CounteragentController::class, 'list']);

    Route::get('/me', [AuthController::class, 'authGetMe']);
    Route::get('/account/delete', [AuthController::class, 'deleteMyAccount']);

    // Возвращает списк эндпоинтов
    Route::get('/routes', function (){
        $routes = app('router')->getRoutes()->getRoutes();
        $listRoutes = [];
        foreach ($routes as $route) {
            foreach ($route->methods() as $method) {
                if (array_key_exists('controller',$route->action) && $route->action['controller']) {

                    if ($method == "HEAD") {continue;}

                    $listRoutes[] = [
                        "method"=>$method,
                        "url"=>URL::to($route->uri),
                        "controller"=>$route->action['controller'],
                        "middleware"=>$route->action['middleware']
                    ];
                }
            }
        }
        return $listRoutes;
    });

});
