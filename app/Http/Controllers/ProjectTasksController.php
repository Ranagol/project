<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Task;

use App\Project;

class ProjectTasksController extends Controller
{
	public function store(Project $project){//here we use route model binding to fetch the right project for our task. Project is the model that we created, and it fetches data from db. Laravel reads the wild card id number from the uri, where the user is. (example: http://127.0.0.1:8000/projects/2/tasks----- so, the id number is 2). So Laravel here puts all this together, and assumes that we want to fetch data for id number 2, into the $project variable. 

		$attributes = request()->validate(['description' => 'required']);
		
		$project->addTask($attributes);//add a new task for this $project that we received as an argument through route model binding, from the uri and the db. And for this use the description from the uri, that was typed by the user, and it has been validated and saved in the $attributes variable.

		return back();
	}



    public function update(Task $task){//Task is the model that we created, and it fetches data from db. Laravel reads the wild card id number from the uri, where the user is. (example: http://127.0.0.1:8000/tasks/2----- so, the id number is 2). So Laravel here puts all this together, and assumes that we want to fetch data for id number 2, into the $task variable. This part here (Task $task) is called route model binding. So, what is happening here: we are fetching a value from the request (completed), and based on this value we are calling two different methods.
    	
    	$method = request()->has('completed') ? 'complete' : 'incomplete';//OK. Here we have a ternary operator, saved in the $method variable. What we are saying here: If the request has a 'completed' in it, then activate the complete() method from Task.php. In the opposite case, activate the incomplete() method from the Task.php...

    	$task->$method();//... and activate the complete() or incomplete() method to make the task completed or incompleted.
    	
    	return back();//The back() method loads the previous URL in the history list.
    }

}
