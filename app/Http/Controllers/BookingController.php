<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function store()
    {
        $nowShowing = Movie::where('year', '<=', now()->year)->latest()->take(6)->get();
        $comingSoon = Movie::where('year', '>', now()->year)->orWhereNull('year')->take(6)->get();

        return view('home', compact('nowShowing', 'comingSoon'));
    }
}
