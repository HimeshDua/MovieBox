<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\SigninController;
use App\Http\Controllers\SignupController;
use Illuminate\Support\Facades\Route;

// home page
Route::get('/', [HomeController::class, "index"]);

// auth pages
Route::get('/signin', [SigninController::class, "showlogin"])->name("signin");
Route::post('/signin', [SigninController::class, "login"]);

Route::post('/signout', [SigninController::class, "signout"])->middleware('auth')->name('signout');

Route::get('/signup', [SignupController::class, "showRegister"])->name("signup");
Route::post('/signup', [SignupController::class, "register"]);

Route::get('/movies/create', [MovieController::class, 'create'])->name('movies.create');
Route::get('/movies', [MovieController::class, "index"])->name("movies.index");
Route::get('/movies/{movie:slug}', [MovieController::class, "detail"])->name("movies.detail");

Route::post('/movies', [MovieController::class, 'store'])->name('movies.store');
// Accept movie as parameter in controller
Route::post('/reviews', [ReviewController::class, 'store'])->middleware('auth')->name('reviews.store');
