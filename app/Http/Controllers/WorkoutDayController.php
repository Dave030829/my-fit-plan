<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\WorkoutDay;
use App\Models\ExerciseName;
use App\Models\ExerciseValue;

class WorkoutDayController extends Controller
{
    public function create(Request $request)
    {
        $userId = Auth::id();
        $days = [];

        $defaultExerciseCount = 4;
        $defaultSetCount = 4;

        for ($dayIndex = 1; $dayIndex <= 3; $dayIndex++) {
            // Keressük az adott nap adatait
            $workoutDay = WorkoutDay::where('user_id', $userId)
                ->where('day_index', $dayIndex)
                ->first();

            $days[$dayIndex]['dayName'] = $workoutDay ? $workoutDay->workout_day : '';

            if ($workoutDay) {
                $dbExerciseCount = ExerciseName::where('workout_id', $workoutDay->workout_id)->count();
                $exerciseCount = $dbExerciseCount ? $dbExerciseCount : $defaultExerciseCount;
            } else {
                $exerciseCount = $defaultExerciseCount;
            }
            $days[$dayIndex]['exerciseCount'] = $exerciseCount;

            for ($exerciseIndex = 1; $exerciseIndex <= $exerciseCount; $exerciseIndex++) {
                $exercise = null;
                if ($workoutDay) {
                    $exercise = ExerciseName::where('workout_id', $workoutDay->workout_id)
                        ->where('exercise_index', $exerciseIndex)
                        ->first();
                }
                $days[$dayIndex]['exercises'][$exerciseIndex]['name'] = $exercise ? $exercise->exercise_name : '';

                if ($exercise) {
                    $dbSetCount = ExerciseValue::where('exercise_id', $exercise->exercise_id)
                        ->max('set_number'); // a legnagyobb set_number értéke
                    $setCount = $dbSetCount ? max($defaultSetCount, $dbSetCount) : $defaultSetCount;
                } else {
                    $setCount = $defaultSetCount;
                }
                $days[$dayIndex]['exercises'][$exerciseIndex]['setCount'] = $setCount;

                for ($setNum = 1; $setNum <= $setCount; $setNum++) {
                    $exerciseValue = null;
                    if ($exercise) {
                        $exerciseValue = ExerciseValue::where('exercise_id', $exercise->exercise_id)
                            ->where('set_number', $setNum)
                            ->first();
                    }
                    $days[$dayIndex]['exercises'][$exerciseIndex]['sets'][$setNum] = $exerciseValue ? $exerciseValue->sets : 0;
                    $days[$dayIndex]['exercises'][$exerciseIndex]['weight'][$setNum] = $exerciseValue ? $exerciseValue->weight : 0;
                    $days[$dayIndex]['exercises'][$exerciseIndex]['done'][$setNum] = $exerciseValue ? $exerciseValue->done : 0;
                }
            }
        }

        return view('workouts.create', compact('days', 'defaultExerciseCount', 'defaultSetCount'));
    }

    public function store(Request $request)
    {
        $userId = Auth::id();

        $request->validate([
            'day_name.*' => 'required|string|max:255',
        ]);

        for ($dayIndex = 1; $dayIndex <= 3; $dayIndex++) {
            $dayName = $request->input("day_name.$dayIndex");

            // WorkoutDay upsert (user + day_index alapján)
            $workoutDay = WorkoutDay::updateOrCreate(
                [
                    'user_id' => $userId,
                    'day_index' => $dayIndex,
                ],
                [
                    'workout_day' => $dayName,
                ]
            );

            // A beküldött edzésblokkok (gyakorlatok) tömbje
            $submittedExercises = $request->input("exercise_name.$dayIndex", []);
            foreach ($submittedExercises as $exerciseIndex => $exerciseNameInput) {
                if (empty($exerciseNameInput)) {
                    $exerciseNameInput = "Gyakorlat #$exerciseIndex (Nap $dayIndex)";
                }

                $exercise = ExerciseName::updateOrCreate(
                    [
                        'workout_id' => $workoutDay->workout_id,
                        'exercise_index' => $exerciseIndex,
                    ],
                    [
                        'exercise_name' => $exerciseNameInput
                    ]
                );

                $submittedSets = $request->input("exercise_{$dayIndex}_{$exerciseIndex}_sets", []);
                foreach ($submittedSets as $setNum => $setsInput) {
                    $weightInput = $request->input("exercise_{$dayIndex}_{$exerciseIndex}_weight.$setNum", 0);
                    $doneInput = $request->input("exercise_{$dayIndex}_{$exerciseIndex}_done.$setNum", 0);

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

                $existingSets = ExerciseValue::where('exercise_id', $exercise->exercise_id)->get();
                $submittedSetNumbers = array_keys($submittedSets);
                foreach ($existingSets as $set) {
                    if (!in_array($set->set_number, $submittedSetNumbers)) {
                        $set->delete();
                    }
                }
            }

            $existingExercises = ExerciseName::where('workout_id', $workoutDay->workout_id)->get();
            $submittedExerciseIndexes = array_keys($submittedExercises);
            foreach ($existingExercises as $ex) {
                if (!in_array($ex->exercise_index, $submittedExerciseIndexes)) {
                    ExerciseValue::where('exercise_id', $ex->exercise_id)->delete();
                    $ex->delete();
                }
            }
        }

        return redirect()->route('workout.create')
            ->with('success', 'Az edzés adatai sikeresen frissültek / mentve lettek!');
    }
}
