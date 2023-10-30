<?php

use App\Http\Controllers\Authentication\LoginController;
use App\Http\Controllers\Authentication\LogoutController;
use App\Http\Controllers\Authentication\RegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

// -=-=-=-=-=-= Home controller =-=-=-=-=-=-=-
Route::get('/', [HomeController::class, 'index'])->name('home');
// -=-=-=-=-=-= End Home controller =-=-=-=-=-=-=-

// -=-=-=-=-=-= Authentication (login, register, logout) =-=-=-=-=-=-=-
Route::middleware('guest')->group(function () {
  Route::get('/login', [LoginController::class, 'index'])->name('login');
  Route::post('/login', [LoginController::class, 'authenticate']);

  Route::get('/register', [RegisterController::class, 'index'])->name('register');
  Route::post('/register', [RegisterController::class, 'store']);
});

Route::middleware('auth')->group(function () {
  Route::get('/logout', [LogoutController::class, 'index'])->name('logout');
});
// -=-=-=-=-=-= End Authentication (login, register, logout) =-=-=-=-=-=-=-

// -=-=-=-=-=-= Tasks =-=-=-=-=-=-=-
Route::group(['prefix' => 'tasks'], function () {
  Route::get('/', [TaskController::class, 'index'])->name('tasks');
  Route::get('/{task}/edit', [TaskController::class, 'edit'])->name('tasks.edit');

  Route::post('/save', [TaskController::class, 'store']);
  Route::post('/search', [TaskController::class, 'search']);

  Route::put('/{task}', [TaskController::class, 'update']);
  Route::delete('/{task}', [TaskController::class, 'destroy']);
});
// -=-=-=-=-=-= End Tasks =-=-=-=-=-=-=-
