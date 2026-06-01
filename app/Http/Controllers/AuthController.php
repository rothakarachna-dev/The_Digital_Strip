<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    
    // Display the signup page.
    public function showSignup()
    {
        return view('auth.signup');
    }

    /**
     * Handle user registration.
     * - Validates input data
     * - Creates a new user record
     * - Automatically logs the user in
     * - Redirects to homepage after successful signup
     */
    public function signup(Request $request)
    {
        // Validate incoming request data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
        ]);

        // Create a new user in the database
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Log the user in immediately after registration
        Auth::login($user);

        // Redirect user to homepage after successful signup
        return redirect('/');
    }

    /**
     * Display the login page.
     */
    public function showLogin()
    {
        return view('auth.login');
    }

    /**
     * Handle user login attempt.
     * - Validates credentials
     * - Authenticates user session
     * - Redirects to homepage on success
     */
        public function login(Request $request)
    {
        // Validate login input
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Attempt authentication
        if (Auth::attempt($credentials)) {

        $request->session()->regenerate();

        if (Auth::attempt($credentials)) {

            $request->session()->regenerate();

            return redirect()->route('admin.index');
        }
    }

        // Return error if authentication fails
        return back()->withErrors([
            'email' => 'Invalid email or password.',
        ]);
    }

    /**
     * Log the user out and clear session data.
     */
    public function logout(Request $request)
{
    Auth::logout();

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect('/');
}
}