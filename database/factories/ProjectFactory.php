<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "name" => fake()->text(5),
            "description" => fake()->text(30),
            "start_date" => fake()->date(),
            "end_date" => fake()->date(),
            "status" => fake()->randomElement([
                "Начат",
                "В разработке",
                "Завершен",
            ])
        ];
    }
}
