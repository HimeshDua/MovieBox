<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\ReviewController;
use Illuminate\Support\Facades\Route;

// home page
Route::get('/', [HomeController::class, "index"]);

// register
Route::get('/register', [AuthController::class, "showRegister"])->name("register");
Route::post('/register', [AuthController::class, "register"]);

// login
Route::get('/login', [AuthController::class, 'showLogin'])->name("login");
Route::post('/login', [AuthController::class, "login"]);

// logout
Route::post('/logout', [AuthController::class, "logout"])->middleware('auth')->name('logout');

Route::get('/movies/create', [MovieController::class, 'create'])->name('movies.create');
Route::get('/movies', [MovieController::class, "index"])->name("movies.index");
Route::get('/movies/{movie:slug}', [MovieController::class, "detail"])->name("movies.detail");

Route::post('/movies', [MovieController::class, 'store'])->name('movies.store');
// Accept movie as parameter in controller
Route::post('/reviews', [ReviewController::class, 'store'])->middleware('auth')->name('reviews.store');
