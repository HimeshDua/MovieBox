<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    public function index()
    {
        $movies = Movie::orderBy("updated_at", "desc")->paginate(6);
        return view("movies.index", ["movies" => $movies]);
    }

    public function detail(Movie $movie)
    {
        return view("movies.detail", compact('movie'));
    }
}
