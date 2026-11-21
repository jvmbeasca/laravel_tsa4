<?php

namespace App\Http\Controllers;

use App\Mail\TaskCompletedMail;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class TaskController extends Controller
{
    public function welcome()
    {
        $tasks = Task::where('is_archived', false)
            ->whereDate('task_date', today())
            ->orderBy('id')
            ->get();

        return view('welcome', compact('tasks'));
    }

    public function index()
    {
        $tasks = Task::where('is_archived', false)
            ->orderBy('task_date')
            ->orderBy('id')
            ->get();

        return view('tasks', compact('tasks'));
    }

    public function profile()
    {
        $user = User::first();

        return view('profile', compact('user'));
    }

    public function about()
    {
        return view('about');
    }

    public function create()
    {
        return view('task-form', ['task' => null]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'status' => ['required', 'in:pending,in_progress,done'],
            'task_date' => ['required', 'date'],
        ]);

        Task::create($validated);

        return redirect()
            ->route('tasks.index')
            ->with('success', 'Task created successfully.');
    }

    public function edit(Task $task)
    {
        abort_if($task->is_archived, 404);

        return view('task-form', compact('task'));
    }

    public function update(Request $request, Task $task)
    {
        abort_if($task->is_archived, 404);

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'status' => ['required', 'in:pending,in_progress,done'],
            'task_date' => ['required', 'date'],
        ]);

        $wasAlreadyDone = $task->status === 'done';

        $task->update($validated);

        if (! $wasAlreadyDone && $task->status === 'done') {
            Mail::to(config('tasks.completion_recipient'))
                ->send(new TaskCompletedMail($task));
        }

        return redirect()
            ->route('tasks.index')
            ->with('success', 'Task updated successfully.');
    }

    public function archive(Task $task)
    {
        abort_if($task->is_archived, 404);

        $task->update(['is_archived' => true]);

        return redirect()
            ->route('tasks.index')
            ->with('success', 'Task archived successfully.');
    }

    public function archived()
    {
        $tasks = Task::where('is_archived', true)
            ->orderBy('task_date')
            ->orderBy('id')
            ->get();

        return view('archived-tasks', compact('tasks'));
    }

    public function restore(int $id)
    {
        $task = Task::where('is_archived', true)->findOrFail($id);
        $task->update(['is_archived' => false]);

        return redirect()
            ->route('tasks.archived')
            ->with('success', 'Task restored successfully.');
    }
}