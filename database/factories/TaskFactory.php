<?php

namespace Database\Factories;

use App\Models\TaskStatus;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends Factory<Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state
     * 
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name'             => $this->faker->sentence,
            'description'      => $this->faker->paragraph,
            'status_id'        => TaskStatus::factory()
                ->create([
                    'name' => $this->faker->randomElement(TaskStatus::ALLOWED_OPTIONS)
                ])->id,
            'created_by_id'    => User::factory()->create()->id,
            'assigned_to_id'   => User::factory()->create()->id,
            'label_id'         => $this->faker->randomNumber(1)
        ];
    }
}
