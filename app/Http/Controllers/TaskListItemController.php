<?php

namespace App\Http\Controllers;

use App\Models\TaskList;
use App\Models\TaskListItem;
use Illuminate\Http\Request;

class TaskListItemController extends Controller
{
    //
    public function create(Request $request){
        $taskListId = $request->input('taskListId');
        $taskList = TaskList::where('id','=', $taskListId)->with('workspace')->get()->first();
        if ($taskList && $taskList->workspace->user_id == auth()->id()){
            $task = TaskListItem::make();
            $task->task_list_id = $taskListId;
            $task->name = $request->input('name');
            $task->description = $request->input('description');
            $task->order = $taskList->size();
            $task->save();
        }
    }

    public function delete(Request $request){
        $item = TaskListItem::findOrFail($request->id);
        if (auth()->id() == $item->taskList->workspace()->sole()->user_id){
            $item->delete();
        };
    }

}
