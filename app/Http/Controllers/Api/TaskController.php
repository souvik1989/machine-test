<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\TaskCategory;
use App\Models\Task;
use App\Http\Requests\TaskRequest;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $tasks = Task::orderByDesc('created_at')->get();
            return response([

                $tasks
            ], Response::HTTP_OK);
        } catch (\Throwable $th) {
            return response([
                'message' => 'Record not found!',
            ], Response::HTTP_NOT_FOUND);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TaskRequest $request)
    {
        try {
            $task = Task::create($request->all());

            return response()->json([
                'success' => true,
                'message' => 'Task created successfully.',
                'task' => $task
            ], Response::HTTP_CREATED);
        } catch (\Throwable $th) {
            return response([
                'message' => 'Record not found!',
            ], Response::HTTP_NOT_FOUND);
        }
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TaskRequest $request, Task $task)
    {
        try {
            $task->update($request->all());

            return response()->json([
                'success' => true,
                'message' => 'Task updated successfully.',
                'task' => $task
            ]);
        } catch (\Throwable $th) {
            return response([
                'message' => 'Record not found!',
            ], Response::HTTP_NOT_FOUND);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        try {
            $task->delete();

            return response()->json([
                'success' => true,
                'message' => 'Task deleted successfully.'
            ], Response::HTTP_NO_CONTENT);
        } catch (\Throwable $th) {
            return response([
                'message' => 'Record not found!',
            ], Response::HTTP_NOT_FOUND);
        }
    }

    public function status($id)
    {
        try {
            $task = Task::findOrFail($id);
            $task->status = $task->status == '0' ? '1' : '0';
            $task->save();

            return response([

                'task'=>$task,
                'message' => 'Task status updated successfully.',
            ], Response::HTTP_OK);
        } catch (\Throwable $th) {
            return response([
                'message' => 'Record not found!',
            ], Response::HTTP_NOT_FOUND);
        }
    }
}
