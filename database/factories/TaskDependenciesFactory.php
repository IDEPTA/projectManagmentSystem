<?php

namespace Database\Factories;

use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class TaskDependenciesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $tasks = Task::pluck("id")->toArray();
        $users = User::pluck("id")->toArray();
        return [
            "task_id" => fake()->randomElement($tasks),
            "user_id" => fake()->randomElement($users)
        ];
    }
}
