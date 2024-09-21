<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskCategoryController;
use App\Http\Controllers\TaskController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth' , 'verified'])->group(function () {
    Route::get('/dashboard', function () {
            return view('dashboard');
        })->name('dashboard');
        
    // Task management routes
   
    Route::resource('category', TaskCategoryController::class);
    Route::resource('tasks', TaskController::class);
    Route::post('tasks/{id}/status', [TaskController::class, 'status'])->name('tasks.status');
    Route::post('category/{id}/status', [TaskCategoryController::class, 'status'])->name('category.status');
    Route::post('tasks/{id}/priority', [TaskController::class, 'priority'])->name('tasks.priority');


});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
