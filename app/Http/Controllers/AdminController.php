<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Show;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class AdminController extends Controller
{
    // Show dashboard overview
    public function show()
    {
        return view('admin.dashboard', [
            'moviesCount' => Movie::count(),
            'usersCount' => User::count(),
            'showsCount' => Show::count(),
        ]);
    }

    // Show all movies
    public function showMovies()
    {
        $movies = Movie::latest()->paginate(10);
        return view('admin.movies.index', compact('movies'));
    }

    public function createMovie()
    {
        return view('admin.movies.create');
    }

    // Store new movie
    public function storeMovie(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'language' => 'nullable|string|max:100',
            'category' => 'nullable|string|max:100',
            'duration' => 'nullable|integer',
            'year' => 'nullable|integer',
            'rating' => 'nullable|numeric|min:0|max:10',
            'poster' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'link' => 'nullable|url',
            'trailer_url' => 'required|url',
        ]);

        $image = $request->file('poster');
        $filename = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('posters'), $filename);

        $validated['poster'] = $filename;

        Movie::create($validated);

        return redirect()->route('admin.dashboard')->with('success', 'Movie created successfully.');
    }

    // Show edit form for movie
    public function editMovie(Movie $movie)
    {
        return view('admin.movies.edit', compact('movie'));
    }

    // Update movie
    public function updateMovie(Request $request, Movie $movie)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'language' => 'nullable|string|max:100',
            'category' => 'nullable|string|max:100',
            'duration' => 'nullable|integer',
            'year' => 'nullable|integer',
            'rating' => 'nullable|numeric|min:0|max:10',
            'poster' => 'nullable|url',
            'link' => 'nullable|url',
            'trailer_url' => 'required|url',
        ]);

        $movie->update($validated);

        return redirect()->back()->with('success', 'Movie updated successfully.');
    }

    // Delete movie
    public function destroyMovie(Movie $movie)
    {
        $movie->delete();
        return back()->with('success', 'Movie deleted.');
    }

    // Show all shows
    public function showShows()
    {
        $shows = Show::with('movie')->latest()->paginate(10);
        return view('admin.shows.index', compact('shows'));
    }

    // Show form to create new show
    public function createShow()
    {
        $movies = Movie::all();
        return view('admin.shows.create', compact('movies'));
    }

    // Store new show
    public function storeShow(Request $request)
    {
        $validated = $request->validate([
            'movie_id' => 'required|exists:movies,id',
            'city' => 'required|string|max:255',
            'location' => 'nullable|string|max:255',
            'show_time' => 'required',
            'show_date' => 'required|date',
            'price_silver' => 'required',
            'price_gold' => 'required',
            'price_platinum' => 'required',
        ]);

        Show::create($validated);

        return redirect()->route('admin.shows.index')->with('success', 'Show created successfully.');
    }

    // Edit form for show 
    public function editShow(Show $show)
    {
        $movies = Movie::latest()->get();
        return view('admin.shows.edit', ['show' => $show, 'movies' => $movies]);
    }

    // Update show
    public function updateShow(Request $request, Show $show)
    {
        $validated = $request->validate([
            'movie_id' => 'required|exists:movies,id',
            'city' => 'required|string|max:255',
            'location' => 'nullable|string|max:255',
            'show_time' => 'required',
            'show_date' => 'required|date',
            'price_silver' => 'required',
            'price_gold' => 'required',
            'price_platinum' => 'required',
        ]);

        $show->update($validated);

        return redirect()->route('admin.shows.index')->with('success', 'Show updated successfully.');
    }

    // Delete Show
    public function destroyShow(Show $show)
    {
        $show->delete();
        return back()->with('success', 'Show deleted.');
    }

    // listUsers
    public function listUsers()
    {
        $users =  User::with('bookings')->latest()->get();
        return view('admin.users.index', compact('users'));
    }
}
