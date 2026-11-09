<?php

namespace Database\Seeders;

use App\Models\Task;
use Database\Factories\TaskFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    const TASK_COUNTER = 25;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($seedId = 0; $seedId < self::TASK_COUNTER; $seedId++) {
            Task::factory()->withLabels(3)->create();
        }
    }
}
