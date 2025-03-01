<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{


    public function redirectToGoogle()
    {
        return Socialite::driver('google')
            ->with(['prompt' => 'select_account'])
            ->redirect();
    }


    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->stateless()->user();

            if (!$googleUser->getEmail()) {
                return redirect()->route('login')->withErrors(['error' => 'Nem található érvényes e-mail cím a Google-fiókban.']);
            }

            $user = User::where('email', $googleUser->getEmail())->first();

            if (!$user) {
                $user = User::create([
                    'username' => $googleUser->getName() ?? 'Ismeretlen felhasználó',
                    'email' => $googleUser->getEmail(),
                    'password' => bcrypt(str()->random(16)),
                ]);
            }

            Auth::login($user, true);

            return redirect('/')->with('success', 'Sikeresen bejelentkeztél Google-fiókkal!');
        } catch (\Exception $e) {
            \Log::error('Google login exception: ' . $e->getMessage());
            return redirect()->route('login')->withErrors(['error' => 'Hiba történt a Google bejelentkezés során.']);
        }

    }

}
