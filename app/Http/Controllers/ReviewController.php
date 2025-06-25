<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;
use App\Models\Review;

class ReviewController extends Controller
{
    public function store(Request $req)
    {
        $credentials =  $req->validate([
            'rating' => 'required|integer|min:1|max:10',
            'comment' => 'required|string|max:500',
            'movie_id' => 'required|exists:movies,id',
        ]);

        $movie = Movie::findOrFail($req->movie_id);

        $movie->reviews()->create([
            'user_id' => auth()->id(),
            'rating' => $req->rating,
            'comment' => $req->comment,
        ]);

        return redirect()->route('movies.detail', $movie->slug)->with('status', 'Review submitted successfully!');
    }
}
