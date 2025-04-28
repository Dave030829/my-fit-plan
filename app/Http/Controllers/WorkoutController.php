<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\WorkoutDay;
use App\Models\ExerciseName;
use App\Models\ExerciseValue;

class WorkoutController extends Controller
{
    public function follow()
    {
        $userId = Auth::id();

        $days = [];
        for ($dayIndex = 1; $dayIndex <= 3; $dayIndex++) {
            $workoutDay = WorkoutDay::where('user_id', $userId)
                ->where('day_index', $dayIndex)
                ->first();

            if (!$workoutDay) {
                continue;
            }

            $days[$dayIndex]['dayName'] = $workoutDay->workout_day;

            $exercises = ExerciseName::where('workout_id', $workoutDay->workout_id)->get();
            foreach ($exercises as $exercise) {
                $exIndex = $exercise->exercise_index;
                $days[$dayIndex]['exercises'][$exIndex]['name'] = $exercise->exercise_name;

                // Set-értékek
                $values = ExerciseValue::where('exercise_id', $exercise->exercise_id)->get();
                foreach ($values as $val) {
                    $setNum = $val->set_number;
                    $days[$dayIndex]['exercises'][$exIndex]['sets'][$setNum] = $val->sets;
                    $days[$dayIndex]['exercises'][$exIndex]['weight'][$setNum] = $val->weight;
                    $days[$dayIndex]['exercises'][$exIndex]['done'][$setNum] = $val->done;
                }
            }
        }

        return view('workouts.follow', compact('days'));
    }

    public function saveFollow(Request $request)
    {
        $userId = Auth::id();

        for ($dayIndex = 1; $dayIndex <= 3; $dayIndex++) {
            $workoutDay = WorkoutDay::where('user_id', $userId)
                ->where('day_index', $dayIndex)
                ->first();
            if (!$workoutDay) {
                continue;
            }
            $exercises = ExerciseName::where('workout_id', $workoutDay->workout_id)->get();

            foreach ($exercises as $exercise) {
                $exIndex = $exercise->exercise_index;

                $submittedSets = $request->input("exercise_{$dayIndex}_{$exIndex}_sets", []);
                $submittedWeight = $request->input("exercise_{$dayIndex}_{$exIndex}_weight", []);
                $submittedDone = $request->input("exercise_{$dayIndex}_{$exIndex}_done", []);

                foreach ($submittedSets as $setNum => $setsInput) {
                    $weightInput = $submittedWeight[$setNum] ?? 0;
                    $doneInput = $submittedDone[$setNum] ?? 0;

                    ExerciseValue::updateOrCreate(
                        [
                            'exercise_id' => $exercise->exercise_id,
                            'set_number' => $setNum,
                        ],
                        [
                            'sets' => $setsInput,
                            'weight' => $weightInput,
                            'done' => $doneInput,
                        ]
                    );
                }
            }
        }

        if ($request->ajax()) {
            return response()->json([
                'success' => 'Az edzés adatai sikeresen elmentve!',
            ]);
        }

        return redirect()->route('workouts.follow')->with('success', 'Az edzés adatai sikeresen frissítve!');
    }
}
