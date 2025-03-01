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

            // Ellenőrizd, hogy az e-mail cím elérhető-e
            if (!$googleUser->getEmail()) {
                return redirect()->route('login')->withErrors(['error' => 'Nem található érvényes e-mail cím a Google-fiókban.']);
            }

            // Keresd meg a felhasználót az adatbázisban
            $user = User::where('email', $googleUser->getEmail())->first();

            if (!$user) {
                // Ha a felhasználó nem létezik, hozz létre egy újat
                $user = User::create([
                    'username' => $googleUser->getName() ?? 'Ismeretlen felhasználó', // Ha nincs név, állítsd be alapértelmezetten
                    'email' => $googleUser->getEmail(),
                    'password' => bcrypt(str()->random(16)), // Véletlenszerű jelszó
                ]);
            }

            // Jelentkeztesd be a felhasználót
            Auth::login($user, true);

            // Átirányítás a kezdőoldalra
            return redirect('/')->with('success', 'Sikeresen bejelentkeztél Google-fiókkal!');
        } catch (\Exception $e) {
            \Log::error('Google login exception: ' . $e->getMessage());
            return redirect()->route('login')->withErrors(['error' => 'Hiba történt a Google bejelentkezés során.']);
        }

    }

}
