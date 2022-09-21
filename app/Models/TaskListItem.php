<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskListItem extends Model
{
    use HasFactory;

    public function taskList(){
        return $this->belongsTo('App\Models\TaskList');
    }
}
