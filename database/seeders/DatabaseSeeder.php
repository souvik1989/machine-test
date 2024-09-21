<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Task;
use App\Models\TaskCategory;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Task::factory(10)->create(); 
        TaskCategory::factory(10)->create(); 
        User::factory(10)->create(); 
        $this->call(TaskSeeder::class);
        $this->call(TaskCategorySeeder::class); 
        $this->call(UserSeeder::class); 
    }
}
