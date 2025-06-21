<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\MovieController;
use Illuminate\Support\Facades\Route;

// home page
Route::get('/', [HomeController::class, "index"]);

// movie pages
Route::get('/movies', [MovieController::class, "index"])->name("movies.index");
Route::get('/movies/{movie}', [MovieController::class, "detail"])->name("movies.detail");
