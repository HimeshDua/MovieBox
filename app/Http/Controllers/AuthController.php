<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // register
    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $req)
    {
        $credentials = $req->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            'date_of_birth' => ['required', 'date', 'before:today'],

        ]);
        $isAdmin = User::count();

        if ($isAdmin === 0) {
            $credentials['role'] = 'admin';
        }

        $user = User::create($credentials);
        Auth::login($user);
        $dob = Carbon::parse($user->date_of_birth);
        $isKid =  $dob->age >= 12 && $dob->age <= 3;
        session(['isKid' => $isKid]);
        return redirect('/')->with('success', 'User created successfully.');
    }

    // login
    public function showLogin()
    {
        return view("auth.login");
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

    // logout
    public function logout(Request $request)
    {
        if (Auth::check()) {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return redirect('/login');
        }
    }
}
