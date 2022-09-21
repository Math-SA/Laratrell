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

    public function index(){
        return Workspace::all();
    }
    
    public function userSelectedWorkspace(){
        $user = auth()->user()->load('selectedWorkspace.taskLists.tasks');
        $selectedWorkspace = $user->selectedWorkspace;
        if ($selectedWorkspace != null){
            return Inertia::render('Workspace', [
                'workspaces' => $user->workspaces,
                'selectedWorkspace' =>  $selectedWorkspace,
                'taskLists' => $selectedWorkspace->taskLists
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
