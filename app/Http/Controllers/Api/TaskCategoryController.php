<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\TaskCategory;
use App\Http\Requests\TaskCategoryRequest;

class TaskCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $categories = TaskCategory::orderByDesc('created_at')->get();
            return response([

                $categories
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
    public function store(TaskCategoryRequest $request)
    {
        try {
            $category = TaskCategory::create($request->all());

            return response()->json([
                'success' => true,
                'message' => 'Task Category created successfully.',
                'category' => $category
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
    public function edit(string $id) {}

    /**
     * Update the specified resource in storage.
     */
    public function update(TaskCategoryRequest $request, TaskCategory $category)
    {
        try {
            $category->update($request->all());

            return response()->json([
                'success' => true,
                'message' => 'Task category updated successfully.',
                'category' => $category
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
    public function destroy(TaskCategory $category)
    {
        try {
            $category->delete();

            return response()->json([
                'success' => true,
                'message' => 'Task Category deleted successfully.'
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
            $category = TaskCategory::findOrFail($id);
            $category->status = $category->status == '0' ? '1' : '0';
            $category->save();

            return response([

                'category'=>$category,
                'message' => 'Task category status updated successfully.',
            ], Response::HTTP_OK);
        } catch (\Throwable $th) {
            return response([
                'message' => 'Record not found!',
            ], Response::HTTP_NOT_FOUND);
        }
    }
}
