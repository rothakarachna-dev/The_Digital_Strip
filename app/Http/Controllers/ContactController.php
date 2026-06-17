<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
    public function index()
    {
        return view('user.contact');
    }

    public function store(Request $request)
    {
        $request->validate([
            'message' => 'required|string'
        ]);

        $user = Auth::user();

        if (!$user) {
            return back()->with('error', 'You must be logged in.');
        }

        DB::table('contact_messages')->insert([
            'name' => $user->name,
            'email' => $user->email,
            'message' => $request->message,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return back()->with('success', 'Message sent!');
    }
}