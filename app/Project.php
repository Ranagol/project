<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

//What can this project model do? It can ad a task.

class Project extends Model
{
    protected $guarded = [];//these must not be mass assigned. And we leave it empty. This with this $guarded property we are stating what columns in the db can be changed by the user. (Right now, there is no limitation)

    public function tasks(){//this here is an Eloquent relationship. Relationships manage connections between db's, and also they can serve as QueryBuilders.
    	return $this->hasMany(Task::class);//basically here we want to find out which tasks are belonging to a given project.
    }

    /*FOR SOME REASON THIS SHIT WAS REPLACED BY ANOTHER SHIT, FIND THAT NEW SHIT BELOW THIS SHIT
    public function addTask($description){//the $description is the task description typed in by the user.
    	$this->tasks()->create(compact('description'));//tasks() is possibly the tasks() method from above? Soo... create a new task with the given description. With this approach Laravel already knows the associated project. Laravel will apply the project id automatically. So we don't have to worry about the project_id number at all, and it is enough if we provide the description of the task.
    }*/
    public function addTask($task){
    	$this->tasks()->create($task);
    }
}
