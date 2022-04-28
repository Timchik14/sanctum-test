<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\AuthController;


//тут форма регистрации
Route::get('/register', [MainController::class, 'register'])->name('registration-form');

//тут форма входа
Route::get('/login', [MainController::class, 'login'])->name('login-form');

//тут регистрация и создание токена
Route::post('/register', [AuthController::class, 'register'])->name('register');

//тут вход и создание токена
Route::post('/login', [AuthController::class, 'login'])->name('login');

//защищенный маршрут
Route::middleware('auth:sanctum')->get('/protected', [MainController::class, 'protected']);
