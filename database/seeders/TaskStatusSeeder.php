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
        TaskStatus::create(['name' => 'Новый']);
        TaskStatus::create(['name' => 'В работе']);
        TaskStatus::create(['name' => 'На тестировании']);
        TaskStatus::create(['name' => 'Завершён']);
    }
}
