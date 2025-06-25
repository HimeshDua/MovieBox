<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class MovieController extends Controller
{
    public function index()
    {
        $movies = Movie::orderBy("updated_at", "desc")->paginate(6);
        return view("movies.index", ["movies" => $movies]);
    }

    public function detail(Movie $movie)
    {
        $movie->load('shows');
        return view("movies.detail", [
            'movie' => $movie,
            'title' => $movie->title . ' | Movie Box'
        ]);
    }

    /**
     * Show the form for creating a new movie.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('movies.create');
    }

    /**
     * Store a newly created movie in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title'       => ['required', 'string', 'max:255', Rule::unique('movies', 'title')],
            'description' => ['required', 'string'],
            'rating'      => ['required', 'numeric', 'min:0', 'max:10'],
            'category'    => ['nullable', 'string', 'max:100'],
            'language'    => ['nullable', 'string', 'max:100'],
            'duration'    => ['nullable', 'integer', 'min:1'],
            'year'        => ['nullable', 'integer', 'min:1800', 'max:' . (date('Y') + 5)],
            'link'        => ['nullable', 'url', 'max:2048'],
            'trailer_url' => ['required', 'url', 'max:2048', 'starts_with:https://www.youtube.com/embed/'],
            'poster'      => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048']
        ]);

        $posterPath = null;
        if ($request->hasFile('poster')) {
            $posterPath = $request->file('poster')->store('movies/posters', 'public');
        }

        $movie = Movie::create([
            'title'       => $validatedData['title'],
            'description' => $validatedData['description'],
            'rating'      => $validatedData['rating'],
            'category'    => $validatedData['category'] ?? null,
            'language'    => $validatedData['language'] ?? null,
            'duration'    => $validatedData['duration'] ?? null,
            'year'        => $validatedData['year'] ?? null,
            'link'        => $validatedData['link'] ?? null,
            'trailer_url' => $validatedData['trailer_url'],
            'poster'      => $posterPath,
        ]);

        return redirect()->route('movies.detail', $movie->id)
            ->with('success', 'Movie "' . $movie->title . '" added successfully!');
    }
}
