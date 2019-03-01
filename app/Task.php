<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

//What can this Task model do? It can make a task completed, or incompleted. Or it can find to which project does a task belong.

class Task extends Model
{

	protected $guarded = [];//... OK, this is empty, so, nothing is blacklisted, everthing can be mass assigned.



	public function complete($completed = true){//by default, if we call complete() method, it has to set the task as completed. $task->complete(false) should do the opposite.

		$this->update(compact('completed'));
	}


	public function incomplete(){

		$this->complete(false);//possibly here we are referring to the complete() method from above, which was just set to false?
	}



    public function project(){
    	return $this->belongsTo(Project::class);
    }
}
