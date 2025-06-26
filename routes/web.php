<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MovieController;
use Illuminate\Support\Facades\Route;

// home page
Route::get('/', [HomeController::class, "index"]);
Route::post('/logout', [AuthController::class, "logout"])->middleware('auth')->name('logout');

Route::get('/shows', [MovieController::class, "index"])->name("shows.index");
Route::get('/movies', [MovieController::class, "index"])->name("movies.index");

// Auth Routes
Route::middleware('guest')->controller(MovieController::class)->group(function () {
    Route::get('/register', [AuthController::class, "showRegister"])->name("register");
    Route::post('/register', [AuthController::class, "register"]);
    Route::get('/login', [AuthController::class, 'showLogin'])->name("login");
    Route::post('/login', [AuthController::class, "login"]);
});

// Protected Movie Routes
Route::middleware('auth')->controller(MovieController::class)->group(function () {
    Route::get('/movies/create', 'create')->name('movies.create');
    Route::post('/movies', 'store')->name('movies.store');
    Route::post('/reviews', 'reviewstore')->name('reviews.store');
});

Route::get('/movies/{movie:slug}', [MovieController::class, 'detail'])->name("movies.detail");

Route::middleware('auth', 'admin')->controller(AdminController::class)->group(function () {
    Route::middleware('auth', 'admin')->get('/dashboard', 'show')->name("dashboard");
});
