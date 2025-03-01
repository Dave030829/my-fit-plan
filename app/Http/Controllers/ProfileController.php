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
        $user->weight = $request->input('weight');
        $user->height = $request->input('height');
        $user->save();

        return redirect()->back()->with('success', 'Profil sikeresen frissítve!');
    }

    public function updateGoal(Request $request)
    {
        $request->validate([
            'calorie_goal' => 'required|numeric|min:0',
        ]);

        $user = Auth::user();
        $user->calorie_goal = $request->input('calorie_goal');
        $user->save();

        return response()->json(['success' => true]);
    }
}
