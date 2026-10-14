<?php

namespace Database\Seeders;

use App\Models\TaskStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TaskStatusSeeder extends Seeder
{
    public const ALLOWED_OPTIONS = [
        'new',
        'in_progress',
        'testing',
        'completed'
    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $seedList = collect(self::ALLOWED_OPTIONS)
            ->map(fn ($value) => TaskStatus::create([
                'name' => trans("tasks.status.options.{$value}")
            ]));
    }
}
