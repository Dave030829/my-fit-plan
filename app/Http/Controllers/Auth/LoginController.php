<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Megjeleníti a bejelentkezési űrlapot.
     */
    public function showLoginForm()
    {
        return view('login');
    }

    /**
     * Kezeli a bejelentkezést.
     */
    public function login(Request $request)
    {
        // Validáció
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Bejelentkezés
        if (Auth::attempt($credentials)) {
            // Sikeres bejelentkezés után átirányítás a kezdőoldalra
            return redirect()->route('welcome')->with('success', 'Sikeresen bejelentkeztél!');
        }

        // Hibás adatok esetén visszairányítás
        return back()->withErrors(['email' => 'Helytelen bejelentkezési adatok.']);
    }

    /**
     * Kijelentkeztetés
     */
    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('welcome')->with('success', 'Sikeresen kijelentkeztél!');
    }
}
