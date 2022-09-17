<?php

namespace App\Http\Controllers;

use App\Models\TaskList;
use App\Models\TaskListItem;
use App\Models\User;
use App\Models\Workspace;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;

class WorkspaceController extends Controller
{
    //

    public function index(){
        return Workspace::all();
    }
    
    public function mine(){
        $selectedWorkspace = Workspace::find(User::find(auth()->id())->selected_workspace_id);
        if ($selectedWorkspace != null){
            $taskLists =  TaskList::where('workspace_id', $selectedWorkspace->id)->get();
            foreach ($taskLists as $taskList){
                $taskList->tasks = TaskListItem::where('task_list_id', $taskList->id)->orderBy('order')->get();
            }
            return Inertia::render('Workspace', [
                'workspaces' => Workspace::where('user_id', auth()->id())->get(),
                'selectedWorkspace' => $selectedWorkspace,
                'taskLists' => $taskLists
            ]);
        }else{
            return Inertia::render('Workspace', [
                'workspaces' => null,
                'selectedWorkspace' => null,
                'taskLists' => null
            ]);
        }

    }


    public function select(Request $request){
        $user = User::findOrFail(auth()->id());
        if (Workspace::findOrFail($request->workspace_id)->user_id == $user->id){
            $user->selected_workspace_id = $request->workspace_id;
            $user->save();
        }
    }

    public function create(Request $request){
        $workspace = Workspace::make();
        $user = User::findOrFail(auth()->id());
        $workspace->user_id = auth()->id();
        $workspace->name = $request->input('name');
        $workspace->save();
        $user->selected_workspace_id = $workspace->id;
        $user->save();
    }

   
}
