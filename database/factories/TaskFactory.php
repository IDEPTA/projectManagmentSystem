<?php

namespace Database\Factories;

use App\Models\Project;
use Illuminate\Database\Eloquent\Factories\Factory;

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
    public function definition(): array
    {
        $projects = Project::pluck("id")->toArray();
        return [
            "project_id" => fake()->randomElement($projects),
            "name" => fake()->text(10),
            "description" => fake()->text(20),
            "start_date" => fake()->date(),
            "end_date" => fake()->date(),
            "status" => fake()->randomElement([
                "Начат",
                "В разработке",
                "Завершен"
            ]),
            "priority" => fake()->randomElement([
                "Первостепенно",
                "Высокий",
                "Средний",
                "Низкий"
            ])
        ];
    }
}