<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        //Створюємо 3 тестових користувачів
        $users = User::factory(3)->create();

        foreach ($users as $user) {
            //Для кожного користувача створюємо по 2 проєкти
            $projects = Project::factory(2)->create([
                'user_id' => $user->id,
            ]);

            foreach ($projects as $project) {
                //Для кожного проєкту створюємо по 5 задач
                $tasks = Task::factory(5)->create([
                    'project_id' => $project->id,
                    'author_id' => $user->id,
                    'assigned_to' => $users->random()->id,
                ]);

                foreach ($tasks as $task) {
                    //Додаємо по 2-3 коментарі від різних користувачів
                    $commentsCount = rand(2, 3);
                    for ($i = 0; $i < $commentsCount; $i++) {
                        Comment::factory()->create([
                            'task_id' => $task->id,
                            'user_id' => $users->random()->id,
                        ]);
                    }
                }
            }
        }
    }
}