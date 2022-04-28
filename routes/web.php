<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\AuthController;

//тут форма регистрации
Route::get('/', [MainController::class, 'index'])->name('login');

//защищенный маршрут
Route::middleware('auth:sanctum')->get('/protected', [MainController::class, 'show']);

//тут регистрация и создание токена
Route::post('/register', [AuthController::class, 'register'])->name('register');

//тут получаем токен
Route::post('/token', [AuthController::class, 'token']);
