<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SigninController extends Controller
{
    public function showlogin()
    {
        return view("auth.signin");
    }

    public function login(Request $req)
    {
        $credentials = $req->validate([
            'email' => ["required", "email"],
            'password' => ["required"]
        ]);

        if (Auth::attempt($credentials)) {
            $req->session()->regenerate();
            return redirect('/')->with('success', 'You have logged in successfully.');
        }


        return back()->withErrors([
            'email' => 'Invalid credentials.',
        ])->onlyInput('email');
    }

    public function signout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate(); // Clear session data
        $request->session()->regenerateToken(); // Regenerate CSRF token

        return redirect('/signin');
    }
}
