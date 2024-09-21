
<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\TaskCategoryController;
use App\Http\Controllers\Api\TaskController;
use App\Http\Controllers\Api\AuthenticationController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/




// routes/api.php
Route::namespace('Api')->group(function(){
    Route::post("login",[AuthenticationController::class,'userSignin']);
    Route::post("signup",[AuthenticationController::class,'userRegister']);
    Route::middleware(['auth:sanctum'])->group(function(){
        Route::post('logout',[AuthenticationController::class,'userSignout']);
         // List all categories
    Route::get('/list-categories', [TaskCategoryController::class, 'index']);
    
   
    
    // Create a new category
    Route::post('/store-category', [TaskCategoryController::class, 'store']);
    
    // Update an existing category
    Route::post('/update-category/{category}', [TaskCategoryController::class, 'update']);
    
    // Delete a category
    Route::delete('/delete-category/{category}', [TaskCategoryController::class, 'destroy']);
    
    // status change of a category
    Route::patch('/category/{category}/status', [TaskCategoryController::class, 'status']);
    



     // List all tasks
     Route::get('/list-tasks', [TaskController::class, 'index']);
    
     // Create a new task
     Route::post('/store-task', [TaskController::class, 'store']);
     
     // Update an existing task
     Route::post('/update-task/{task}', [TaskController::class, 'update']);
     
     // Delete a task
     Route::delete('/delete-task/{task}', [TaskController::class, 'destroy']);
     
     // status change of a task
     Route::patch('/task/{task}/status', [TaskController::class, 'status']);

     
    
    });
});



