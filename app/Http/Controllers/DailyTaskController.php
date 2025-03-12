<?php

namespace App\Http\Controllers;

use App\Models\DailyTask;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DailyTaskController extends Controller
{
    public function index(Request $request)
    {
        $date = $request->get('date', now()->format('Y-m-d'));

        $tasks = DailyTask::where('user_id', Auth::id())
            ->where('date', $date)
            ->orderBy('id')
            ->get();

        return view('daily_tasks', compact('tasks', 'date'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'tasks' => 'nullable|array',
            'tasks.*.task' => 'required|string|max:255',
            'tasks.*.completed' => 'boolean'
        ]);

        DailyTask::where('user_id', Auth::id())
            ->where('date', $request->date)
            ->delete();

        $tasksData = $request->input('tasks', []);

        foreach ($tasksData as $taskData) {
            DailyTask::create([
                'user_id' => Auth::id(),
                'date' => $request->date,
                'task' => $taskData['task'],
                'completed' => $taskData['completed'] ?? false,
            ]);
        }

        return redirect()
            ->route('daily-tasks.index', ['date' => $request->date])
            ->with('success', 'A teendők mentése sikeres!');
    }
}
