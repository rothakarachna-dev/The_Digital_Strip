<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Laravel\Socialite\Two\GoogleProvider;

class GoogleController extends Controller
{
    public function redirect()
    {
        /** @var GoogleProvider $driver */
        $driver = Socialite::driver('google');

        return $driver->with(['prompt' => 'select_account'])->redirect();
    }

    public function callback()
    {
        $googleUser = Socialite::driver('google')->user();

        $user = User::updateOrCreate(
            ['email' => $googleUser->getEmail()],
            [
                'name' => $googleUser->getName(),
                'google_id' => $googleUser->getId(),
            ]
        );

        Auth::guard('web')->login($user, true);

        return redirect()->route('home');
    }
}