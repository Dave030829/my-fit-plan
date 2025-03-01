<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    public function showLoginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        // Validáció
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Eldöntjük, hogy a felhasználó pipálta-e be a 'Maradjak bejelentkezve' opciót
        $remember = $request->has('remember');

        // Ha a 'remember' paraméter true, a Laravel beállítja a "remember_token"-t
        if (Auth::attempt($credentials, $remember)) {
            return redirect()->route('welcome')->with('success', 'Sikeresen bejelentkeztél!');
        }

        return back()->withErrors(['email' => 'Helytelen bejelentkezési adatok.']);
    }


    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('welcome')->with('success', 'Sikeresen kijelentkeztél!');
    }
}
