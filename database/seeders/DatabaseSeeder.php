<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Team;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $user =  \App\Models\User::factory()->createOne([
            'name' => 'Test User',
            'email' => 'test@fakedomain.com',
            'password' => Hash::make('devplay123')
       ]);
       $user->ownedTeams()->save(Team::forceCreate([
        'user_id' => $user->id,
        'name' => explode(' ', $user->name, 2)[0]."'s Team",
        'personal_team' => true,
        ]));

        $workspace = \App\Models\Workspace::factory()->create([
            'user_id' => $user->id,
            'name' => 'Main workspace'
        ]);

        $user->selected_workspace_id = $workspace->id;
        $user->save();

        $workspace2 = \App\Models\Workspace::factory()->create([
            'user_id' => $user->id,
            'name' => 'Another workspace'
        ]);

        $taskList = \App\Models\TaskList::factory()->create([
            'name' => 'TODO',
            'workspace_id' => $workspace->id,
            'order' => 0
        ]);

        $taskListItem1 = \App\Models\TaskListItem::factory()->create([
            'task_list_id' => $taskList->id,
            'name' => 'A tedious task',
            'description' => 'boooooooriiiiiiiiiiiiiiiiiiiiiiiiiiiing',
            'order' => '0'
        ]);

        $taskListItem2 = \App\Models\TaskListItem::factory()->create([
            'task_list_id' => $taskList->id,
            'name' => 'Another tedious task',
            'description' => 'yaaaaaaaaaaaaaaaaaaaAAAAaaaAAAaaawn',
            'order' => '1'
        ]);

        $taskListItem2 = \App\Models\TaskListItem::factory()->create([
            'task_list_id' => $taskList->id,
            'name' => 'A tedious task',
            'description' => 'boooooooriiiiiiiiiiiiiiiiiiiiiiiiiiiing',
            'order' => '2'
        ]);

        $taskListItem3 = \App\Models\TaskListItem::factory()->create([
            'task_list_id' => $taskList->id,
            'name' => 'Fun, at last!',
            'description' => 'FUN! YAAAAAAAAAAAAAAAAAAAAAAAAAY',
            'order' => '3'
        ]);


        $taskList2 = \App\Models\TaskList::factory()->create([
            'name' => 'Doing',
            'workspace_id' => $workspace->id,
            'order' => 1
        ]);

        $taskList3 = \App\Models\TaskList::factory()->create([
            'name' => 'Done',
            'workspace_id' => $workspace->id,
            'order' => 2
        ]);



        
    }
}
