<?php

namespace App\Http\Controllers;

use App\Models\Challenge;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ChallengeController extends Controller
{

    public function index(Request $request)
    {
        $user = auth()->user();


        $userPivotChallenges = $user->challenges()->get();

        $difficultyFilter = $request->input('difficulty');
        if ($difficultyFilter && in_array($difficultyFilter, ['könnyű', 'haladó', 'nehéz'])) {
            $challenges = Challenge::where('difficulty', $difficultyFilter)->get();
        } else {
            $challenges = Challenge::all();
        }


        if (!$userPivotChallenges->isEmpty()) {
            $selectedChallenge = $userPivotChallenges->first();


            $leaderboard = $selectedChallenge
                ->users
                ->sortByDesc(function ($user) {
                    return $user->pivot->days_completed;
                })
                ->values();
        }

        $leaderboard = collect();
        if (!$userPivotChallenges->isEmpty()) {
            $selectedChallenge = $userPivotChallenges->first();
            $leaderboard = $selectedChallenge
                ->users
                ->sortByDesc(fn($u) => $u->pivot->days_completed)
                ->values();
        }


        return view('challenges', [
            'userPivotChallenges' => $userPivotChallenges,
            'challenges' => $challenges,
            'difficultyFilter' => $difficultyFilter,
            'leaderboard' => $leaderboard,
        ]);
    }



    public function store(Request $request)
    {
        if (!$request->user()->is_admin) {
            abort(403, 'Nincs jogosultságod új kihívást létrehozni.');
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'difficulty' => 'required|in:könnyű,haladó,nehéz',
            'duration_in_days' => 'required|integer|min:1',
        ]);

        Challenge::create($validated);

        return redirect()->route('challenges.index')
            ->with('success', 'Új kihívás létrehozva!');
    }

    public function select(Challenge $challenge)
    {
        $user = auth()->user();

        $user->challenges()->detach();

        $user->challenges()->attach($challenge->id, [
            'days_completed' => 0,
            'last_completed_date' => null,
        ]);

        return redirect()->route('challenges.index')
            ->with('success', 'A kihívás kiválasztva!');
    }


    public function complete(Challenge $challenge)
    {
        $user = auth()->user();
        $pivot = $user->challenges()
            ->where('challenge_id', $challenge->id)
            ->first()
            ->pivot ?? null;

        if (!$pivot) {
            return redirect()->route('challenges.index')
                ->with('error', 'Nem vagy tagja ennek a kihívásnak.');
        }

        $today = Carbon::now()->toDateString();

        if ($pivot->last_completed_date !== $today) {
            $pivot->days_completed += 1;
            $pivot->last_completed_date = $today;
            $pivot->save();

            return redirect()->route('challenges.index')
                ->with('success', 'Mai nap teljesítve!');
        } else {
            return redirect()->route('challenges.index')
                ->with('error', 'A mai napot már teljesítetted!');
        }
    }

    public function destroy(Challenge $challenge)
    {
        if (!auth()->user()->is_admin) {
            abort(403, 'Nincs jogosultságod a kihívások törléséhez.');
        }

        $challenge->delete();

        return redirect()->route('challenges.index')
            ->with('success', 'A kihívás sikeresen törölve!');
    }


}
