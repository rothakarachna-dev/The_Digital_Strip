<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class ProfileController extends Controller
{
   public function edit() {
    return view('user.profile');
}

    public function update(Request $request) {
    $user = User::find(Auth::id());

    $user->name = $request->name;

    if ($request->hasFile('profile_image')) {
        $file = $request->file('profile_image');
        $filename = time().'.'.$file->getClientOriginalExtension();
        $file->move(public_path('uploads/profiles'), $filename);
        $user->profile_image = 'uploads/profiles/'.$filename;
    }

    $user->save();

    return back()->with('success', 'Profile updated!');
}
}
