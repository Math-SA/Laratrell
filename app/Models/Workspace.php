<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Workspace extends Model
{
    use HasFactory;

    public function size(){
        return $this->hasMany('App\Models\TaskList')->count();
    }

    public function taskLists(){
        return $this->hasMany('App\Models\TaskList');
    }
}
