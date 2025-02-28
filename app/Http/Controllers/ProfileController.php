<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function show()
    {
        return view('profile');
    }

    public function update(Request $request)
    {
        $request->validate([
            'age' => 'required|integer|min:10|max:90',
            'gender' => 'required|in:male,female,other',
        ]);

        $user = Auth::user();
        $user->age = $request->input('age');
        $user->gender = $request->input('gender');
        $user->save();

        return redirect()->back()->with('success', 'Profil sikeresen frissítve!');
    }
}

