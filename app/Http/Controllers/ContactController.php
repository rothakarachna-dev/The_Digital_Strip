<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
    public function index()
    {
        return view('contact.contact');
    }

    public function store(Request $request)
    {
        $request->validate([
            'message' => 'required'
        ]);

        $user = Auth::user();

        DB::table('contact_message')->insert([
            'name' => $user->name,
            'email' => $user->email,
            'message' => $request->message,
            'created_at' => now()
        ]);

        return back()->with('success', 'Message sent successfully!');
    }
}