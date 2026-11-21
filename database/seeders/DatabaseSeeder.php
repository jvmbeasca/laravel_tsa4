<?php

namespace Database\Seeders;

use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        Task::query()->delete();

        User::updateOrCreate(
            ['email' => 'jmbeasca@fit.edu.ph'],
            [
                'username' => 'jvmbeasca',
                'full_name' => 'John Vincent Beasca',
                'password' => Hash::make('password'),
            ]
        );

        $yesterday = today()->subDay()->toDateString();
        $today = today()->toDateString();
        $tomorrow = today()->addDay()->toDateString();

        $tasks = [
            ['title' => 'Review class notes', 'status' => 'pending', 'task_date' => $yesterday],
            ['title' => 'Organize study materials', 'status' => 'done', 'task_date' => $yesterday],
            ['title' => 'Attend Web Technologies class', 'status' => 'pending', 'task_date' => $today],
            ['title' => 'Work on the Laravel project', 'status' => 'in_progress', 'task_date' => $today],
            ['title' => 'Submit today’s assignment', 'status' => 'pending', 'task_date' => $today],
            ['title' => 'Prepare for the next lesson', 'status' => 'pending', 'task_date' => $tomorrow],
            ['title' => 'Complete project documentation', 'status' => 'pending', 'task_date' => $tomorrow],
            ['title' => 'Back up project files', 'status' => 'pending', 'task_date' => $tomorrow],
        ];

        foreach ($tasks as $task) {
            Task::create($task);
        }
    }
}