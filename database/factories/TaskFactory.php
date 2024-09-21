<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Task;
use App\Models\TaskCategory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Task::class;
    public function definition(): array
    {
        return [
            'task_category_id' => TaskCategory::factory(), // Assuming tasks belong to a category
            'title' => $this->faker->sentence(6, true), // Generates a random title
            'description' => $this->faker->paragraph(3, true), // Generates a random description
            'due_date' => $this->faker->dateTimeBetween('+1 week', '+1 month'), // Random due date within the next month
            'priority' => $this->faker->numberBetween(0, 2), // Random priority (0 = low, 1 = medium, 2 = high)
            'status' => $this->faker->boolean() ? 1 : 0, // Random status (1 = active, 0 = inactive)
        ];
    }
}
