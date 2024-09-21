<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TaskCategory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\TaskCategoryRequest;

class TaskCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = $request->input('search');
        
        // Filter categories by name if search query is present
        $categories = TaskCategory::when($query, function($queryBuilder) use ($query) {
            return $queryBuilder->where('name', 'like', "%{$query}%");
                               
        })->paginate(10);
        
        return view('category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TaskCategoryRequest $request)
    {
        
        TaskCategory::create($request->all());

        return redirect()->route('category.index')->with('success', 'Category added successfully.');
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
    public function edit(TaskCategory $category)
    {
        return view('category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TaskCategoryRequest $request, TaskCategory $category)
    {
    
        $category->update($request->all());

        return redirect()->route('category.index')->with('success', 'Category updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TaskCategory $category)
    {
        $category->delete();

        return redirect()->route('category.index')->with('success', 'Category deleted successfully.');
    }

    public function status( $id)
{
    $category = TaskCategory::findOrFail($id);
    $category->status = $category->status == '0' ? '1' : '0';
    $category->save(); 

    return redirect()->route('tasks.index')->with('success', 'Task  Category status updated successfully.');
}
}
