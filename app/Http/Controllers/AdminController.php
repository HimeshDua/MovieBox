<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Show;
use App\Models\User;
use Illuminate\Http\Request;

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
            'poster' => 'nullable|url',
            'link' => 'nullable|url',
            'trailer_url' => 'required|url',
        ]);

        Movie::create($validated);

        return redirect()->route('admin.dashboard')->with('success', 'Movie created successfully.');
    }

    // Show edit form for movie
    public function editMovie(Movie $movie)
    {
        return view(
            'admin.movies.edit',
            [
                'movie' => $movie,
                'rout' => $movie->slug,
            ]
        );
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
    public function deleteMovie(Movie $movie)
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
            'class' => 'required|in:Silver,Gold,Platinum',
        ]);

        $priceMap = [
            'Silver' => 500,
            'Gold' => 800,
            'Platinum' => 1200,
        ];

        $validated['price'] = $priceMap[$validated['class']] ?? 0;

        Show::create($validated);

        return redirect()->route('admin.dashboard')->with('success', 'Show created successfully.');
    }


    // TODO: Add editShow() and updateShow() methods
    // TODO: Add deleteShow() method
    // TODO: Add admin user management (list, promote/demote roles, etc.)
    // TODO: Add analytics page (e.g., top movies, total sales, etc.)
}
