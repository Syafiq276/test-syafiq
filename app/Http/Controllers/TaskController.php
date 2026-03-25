<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Auth::user()->tasks()->latest()->get();
        return Inertia::render('Task/index', ['tasks' => $tasks]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $request->user()->tasks()->create($validated);

        return redirect()->route('task.index')->with('success', 'Task created successfully.');
    }

    public function update(Request $request, Task $task)
    {
        if ($task->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'completed' => 'boolean',
        ]);

        $task->update($validated);

        return redirect()->route('task.index')->with('success', 'Task updated successfully.');
    }

    public function destroy(Task $task)
    {
        if ($task->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $task->delete();

        return redirect()->route('task.index')->with('success', 'Task deleted successfully.');
    }
}
