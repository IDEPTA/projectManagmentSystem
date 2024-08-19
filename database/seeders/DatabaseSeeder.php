<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\Role;
use App\Models\Task;
use App\Models\TaskDependencies;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *                 "Backend-разработчик",
                "Frontend-разработчик",
                "Тестировщик",
                "Teamlead",
     */
    public function run(): void
    {
        Role::factory()->create([
            "name" => "Backend-разработчик",
        ]);
        Role::factory()->create([
            "name" => "Frontend-разработчик",
        ]);
        Role::factory()->create([
            "name" => "Тестировщик",
        ]);
        Role::factory()->create([
            "name" => "Teamlead",
        ]);

        User::factory(10)->create();

        Project::factory(5)->create();

        Task::factory(20)->create();

        TaskDependencies::factory(50)->create();
        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
