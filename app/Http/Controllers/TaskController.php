<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Carbon\Carbon;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        $query = Task::query();

        // Recherche
        if ($request->has('search') && $request->input('search') !== '') {
            $searchTerm = $request->input('search');
            $query->where(function($q) use ($searchTerm) {
                $q->where('name', 'like', "%{$searchTerm}%")
                  ->orWhere('description', 'like', "%{$searchTerm}%");
            });
        }

        if ($request->has('status') && $request->input('status') !== '') {
            $status = $request->input('status');
            $query->where('status', $status);
        }

        $tasks = $query->paginate(10); 

        foreach ($tasks as $task) {
            $task->due_date = $task->due_date ? Carbon::parse($task->due_date) : null;
        }

        return view('tasks.index', compact('tasks'));
    }

    public function create()
    {
        return view('tasks.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'priority' => 'required|string|in:High,Medium,Low',
            'due_date' => 'nullable|date',
        ]);

        Task::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'priority' => $request->input('priority'),
            'due_date' => $request->input('due_date'),
        ]);

        return redirect()->route('tasks.index');
    }

    public function show(Task $task)
    {
        return view('tasks.show', compact('task'));
    }

    public function edit(Task $task)
    {
        return view('tasks.edit', compact('task'));
    }

    public function update(Request $request, Task $task)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'priority' => 'required|string|in:High,Medium,Low',
            'due_date' => 'nullable|date',
        ]);

        $task->update([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'priority' => $request->input('priority'),
            'due_date' => $request->input('due_date'),
        ]);

        return redirect()->route('tasks.index');
    }

    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->route('tasks.index');
    }
}
