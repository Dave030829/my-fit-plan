<?php

namespace App\Http\Controllers;

use App\Models\Food;
use Illuminate\Http\Request;

class FoodController extends Controller
{

    public function index(Request $request)
    {
        $search = $request->input('search');

        $foods = Food::where('name', 'like', "%$search%")->paginate(5);

        return view('calorie_tracker', compact('foods', 'search'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'kcal' => 'required|integer|min:0',
            'protein' => 'required|numeric|min:0',
            'fat' => 'required|numeric|min:0',
            'carbs' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:1',
            'unit' => 'required|string|in:db,g,dkg,kg,ml,cl,dl,l,szelet,adag'
        ]);

        Food::create($validated);

        return redirect()->route('foods.index')
            ->with('success', 'Étel sikeresen létrehozva!');
    }

    public function update(Request $request, Food $food)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'kcal' => 'required|integer|min:0',
            'protein' => 'required|numeric|min:0',
            'fat' => 'required|numeric|min:0',
            'carbs' => 'required|numeric|min:0',
        ]);

        $food->update($validated);

        return redirect()->route('foods.index')
            ->with('success', 'Étel sikeresen frissítve!');
    }

    public function destroy(Food $food)
    {
        $food->delete();

        return redirect()->route('foods.index')
            ->with('success', 'Étel törölve!');
    }

    public function searchAjax(Request $request)
    {
        $term = $request->input('term', '');

        if (!$term) {
            return response()->json([]);
        }

        $foods = Food::where('name', 'like', "%{$term}%")
            ->get();

        return response()->json($foods);
    }
}
