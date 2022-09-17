<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskList extends Model
{
    use HasFactory;

    public function workspace(){
        return $this->belongsTo('App\Models\Workspace');
    }

    public function size(){
        return $this->hasMany('App\Models\TaskListItem')->count();
    }

    
}
