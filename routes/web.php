<?php

use App\Http\Controllers\Authentication\LoginController;
use App\Http\Controllers\Authentication\LogoutController;
use App\Http\Controllers\Authentication\RegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TodosController;
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

// -=-=-=-=-=-= Todo's =-=-=-=-=-=-=-
Route::middleware('auth')->group(function () {
  Route::get('/todos', [TodosController::class, 'index'])->name('todos');
  Route::post('/todos/save', [TodosController::class, 'storeTodo']);
  Route::put('/todos/{id}', [TodosController::class, 'updateTodo']);
  Route::delete('/todos/{id}', [TodosController::class, 'deleteTodo']);
});
// -=-=-=-=-=-= End Todo's =-=-=-=-=-=-=-