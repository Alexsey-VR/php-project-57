<?php

namespace Database\Seeders;

use App\Models\TaskStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TaskStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $seedList = TaskStatus::getAllowedTaskStatusOptions();
        $seedList->mapWithKeys(function($value, $key) {
            return TaskStatus::create(['name' => $key]);
        });
    }
}
