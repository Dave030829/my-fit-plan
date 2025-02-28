<?php

namespace App\Http\Controllers;

use App\Models\FoodDiary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FoodDiaryController extends Controller
{

    public function index(Request $request)
    {
        $day = $request->input('day', date('Y-m-d'));

        $rows = FoodDiary::where('food_diary.user_id', Auth::id())
            ->where('food_diary.day', $day)
            ->join('food', 'food_diary.food_id', '=', 'food.id')
            ->select([
                'food_diary.id',
                'food_diary.day',
                'food_diary.quantity',
                'food_diary.unit',
                'food.name',

                // Kcal
                DB::raw("
                    ROUND(
                        CASE WHEN food_diary.unit = 'db'
                             THEN food.kcal * food_diary.quantity
                             ELSE food.kcal * (food_diary.quantity / 100)
                        END
                    , 1) as kcal
                "),

                // Fehérje
                DB::raw("
                    ROUND(
                        CASE WHEN food_diary.unit = 'db'
                             THEN food.protein * food_diary.quantity
                             ELSE food.protein * (food_diary.quantity / 100)
                        END
                    , 1) as protein
                "),

                // Zsír
                DB::raw("
                    ROUND(
                        CASE WHEN food_diary.unit = 'db'
                             THEN food.fat * food_diary.quantity
                             ELSE food.fat * (food_diary.quantity / 100)
                        END
                    , 1) as fat
                "),

                // Szénhidrát
                DB::raw("
                    ROUND(
                        CASE WHEN food_diary.unit = 'db'
                             THEN food.carbs * food_diary.quantity
                             ELSE food.carbs * (food_diary.quantity / 100)
                        END
                    , 1) as carbs
                "),
            ])
            ->get();

        return response()->json($rows);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'food_id' => 'required|exists:food,id',
            'quantity' => 'required|integer|min:1',
            'unit' => 'required|string|in:db,g,ml',
            'day' => 'nullable|string',
        ]);

        $entry = FoodDiary::create([
            'user_id' => Auth::id(),
            'food_id' => $validated['food_id'],
            'quantity' => $validated['quantity'],
            'unit' => $validated['unit'],
            'day' => $validated['day'] ?? date('Y-m-d'),
        ]);

        return response()->json($entry, 201);
    }


    public function destroy($id)
    {
        $entry = FoodDiary::where('id', $id)->where('user_id', Auth::id())->firstOrFail();

        $entry->delete();

        return response()->json(['message' => 'Deleted successfully'], 200);
    }


    public function update(Request $request, $id)
    {
        $entry = FoodDiary::where('id', $id)->where('user_id', Auth::id())->firstOrFail();

        $validated = $request->validate([
            'quantity' => 'required|integer|min:1',
            'unit' => 'required|string|in:db,g,ml',
        ]);

        $entry->quantity = $validated['quantity'];
        $entry->unit = $validated['unit'];
        $entry->save();

        return response()->json($entry);
    }
}
