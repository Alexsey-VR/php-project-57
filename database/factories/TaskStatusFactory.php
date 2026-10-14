<?php

namespace Database\Factories;

use App\Models\TaskStatus;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends Factory<TaskStatus>
 */
class TaskStatusFactory extends Factory
{
    public const ALLOWED_OPTIONS = [
        'new',
        'in_progress',
        'testing',
        'completed'
    ];

    /**
     * Define the model's default state
     * 
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => trans("tasks.status.options.{$this->faker->randomElement(self::ALLOWED_OPTIONS)}")
        ];
    }
}
