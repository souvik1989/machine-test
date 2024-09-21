<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{TaskCategory, Task};
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\TaskRequest;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = $request->input('search');
        $priority = $request->input('priority');

        $tasks = Task::query();

        if ($query != null) {
            $tasks->where('title', 'like', "%{$query}%");
        }

        if ($priority != null) {
            $tasks->where('priority', $priority);
        }

        $tasks = $tasks->paginate(5);
        $noTasksFound = $tasks->isEmpty();

        return view('task.index', compact('tasks', 'noTasksFound'));
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['categories'] = TaskCategory::orderBy('created_at', 'DESC')->get();
        return view('task.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TaskRequest $request)
    {

        Task::create($request->all());

        return redirect()->route('tasks.index')->with('success', 'Task added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        $categories = TaskCategory::orderBy('created_at', 'DESC')->get();
        return view('task.edit', compact(['task', 'categories']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TaskRequest $request, Task $task)
    {
        $task->update($request->all());

        return redirect()->route('tasks.index')->with('success', 'Task updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $task->delete();

        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully.');
    }

    public function status(Request $request, $id)
    {
        $task = Task::findOrFail($id);
        $task->status = $task->status == '0' ? '1' : '0';
        $task->save();

        return redirect()->route('tasks.index')->with('success', 'Task status updated successfully.');
    }

    public function priority(Request $request, $id)
    {
        // Find the task by ID
        $task = Task::findOrFail($id);

        // Update the status based on the current value
        if ($task->priority == '0') {
            $task->priority = '1'; // Change from 0 to 1
        } elseif ($task->priority == '1') {
            $task->priority = '2'; // Change from 1 to 2
        } else {
            $task->priority = '0'; // Change from 2 to 0
        }

        $task->save(); // Persist changes

        return redirect()->route('tasks.index')->with('success', 'Task priority updated successfully.');
    }
}
