<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SignupController extends Controller
{
    public function showRegister()
    {
        return view('auth.register');
    }


    public function register(Request $request)
    {
        // Step 1: Validate inputs
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'confirmed', 'min:6'],
        ]);

        // Step 2: Create user with hashed password
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']), // secure hash
        ]);

        // Step 3: Log user in
        Auth::login($user);

        // Step 4: Redirect to dashboard/home
        return redirect('/');
    }
}
