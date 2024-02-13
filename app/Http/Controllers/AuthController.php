<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    // Show login form
    public function login()
    {
        return view('auth.login');
    }

    // Handle login form submission
    public function authenticate(Request $request)
    {
        // Validate the form data
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Attempt to authenticate the user
        if (Auth::attempt($credentials)) {
            // Authentication successful, redirect to home page or wherever needed
            return redirect()->intended('/');
        } else {
            // Authentication failed, redirect back with error message
            return back()->withErrors(['email' => 'Invalid credentials'])->withInput();
        }
    }

    // Logout the user
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }

    // Show registration form
    public function register()
    {
        return view('auth.register');
    }

    // Handle registration form submission
    public function store(Request $request)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        // Create new user
        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']),
        ]);

        // Authenticate the newly registered user
        Auth::login($user);

        // Redirect to home page or wherever needed
        return redirect()->route('home');
    }
}
