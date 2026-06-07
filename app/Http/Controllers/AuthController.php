<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

        class AuthController extends Controller
        {
            /**
             * Display signup page.
             */
            public function showSignup()
            {
                return view('auth.signup');
            }

            /**
             * Handle user registration.
             */
            public function signup(Request $request)
            {
                $request->validate([
                    'name' => 'required|string|max:255',
                    'email' => 'required|email|unique:users,email',
                    'password' => 'required|min:8|confirmed',
                ]);

                $user = User::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                ]);

                Auth::login($user);

                return redirect('/');
            }

            /**
             * Display login page.
             */
            public function showLogin()
            {
                return view('auth.login');
            }

            /**
             * Handle login.
             */
            public function login(Request $request)
            {
                $credentials = $request->validate([
                    'email' => 'required|email',
                    'password' => 'required',
                ]);

                if (Auth::attempt($credentials)) {

                    $request->session()->regenerate();

                    // Admin account
                    if (Auth::user()->email === 'rothakarachna@gmail.com') {
                        return redirect()->route('admin.index');
                    }

                    // Normal users
                    return redirect('/');
                }

                return back()->withErrors([
                    'email' => 'Invalid email or password.',
                ]);
            }

            /**
             * Logout user.
             */
            public function logout(Request $request)
            {
                Auth::logout();

                $request->session()->invalidate();
                $request->session()->regenerateToken();

                return redirect('/');
            }
        }