<?php

namespace App\Http\Controllers;

use App\Models\TaskList;
use App\Models\TaskListItem;
use App\Models\Workspace;
use Illuminate\Http\Request;


class TaskListController extends Controller
{

    public function move(Request $request){
        $itemId =  $request->input('listItem.id');
        $itemOldList = $request->input('listItem.task_list_id');
        $desiredItemOrder = $request->desiredOrder;
        $itemNewList = $request->taskListId;
        $newListSize = TaskList::find($itemNewList)->size();
        if ($newListSize == 1 && ($itemOldList == $itemNewList)){
            //dropped the only item back into the same list
            //do nothing
            return;
        }
        $item = TaskListItem::findOrFail($itemId);
        TaskListController::remove($itemOldList, $item);
        
        if ($desiredItemOrder < $newListSize-1){//does not want to add to the end of the list
            $item->order = $desiredItemOrder;
            TaskListController::insert($itemNewList, $item);
        }else{
            //if the item has already been counted as children of the new list, fix position to last
            $item->order = ($itemOldList != $itemNewList) ? $newListSize : $newListSize-1; 
        }
        $item->task_list_id = $itemNewList;
        $item->save();
    }

    

    public function insert($task_list_id, $item){
        $list = TaskListItem::where('task_list_id',$task_list_id)->where('order' , '>=', $item->order)->get();
        foreach ($list as $listItem){
            $listItem->order++;
            $listItem->save();  
        }
    }

    public function remove($task_list_id, $item){
        $list = TaskListItem::where('task_list_id',$task_list_id)->where('order' , '>', $item->order)->get();
        foreach ($list as $listItem){
            $listItem->order--;
            $listItem->save();
        }
    }

    public function create(Request $request){
        $workspaceId = $request->input('workspaceId');
        $workspace = Workspace::findOrFail($request->input('workspaceId'));
        if ($workspace && $workspace->user_id == auth()->id()){
            $taskList = TaskList::make();
            $taskList->workspace_id = $workspaceId;
            $taskList->name = $request->input('name');
            $taskList->order = $workspace->size();
            $taskList->save();
        }
    }
}
