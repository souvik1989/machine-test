<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\TaskCategory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TaskCategory>
 */
class TaskCategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

     protected $model = TaskCategory::class;
    public function definition(): array
    {
        return [
            'name' => $this->faker->word, 
            'status' => $this->faker->boolean() ? 1 : 0, 
        ];
    }
}
