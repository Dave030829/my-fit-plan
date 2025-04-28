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
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $remember = $request->has('remember');

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
