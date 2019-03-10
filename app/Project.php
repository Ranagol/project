<?php

namespace App;

use App\Mail\ProjectCreated;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;

//What can this project model do? It can ad a task.

class Project extends Model
{
    protected $guarded = [];//these must not be mass assigned. And we leave it empty. This with this $guarded property we are stating what columns in the db can be changed by the user. (Right now, there is no limitation)

    
    protected static function boot(){
        
        parent::boot();//because we are overriding a method that is actually in the Model class, we are making sure that we call that method from the Model class, by this parent:: part.
        
        static::created(function($project){//we will listen for when this model is created (aka $when this $project is inserted into the db. With the created method here we want to hook in into the created event). And we pass a closure here (an anonymus function). This code will be only executed when a new project is created and inserted into the db. That means, that here we can put our codes about sending an email to a user, when he has created a new project.

            Mail::to($project->owner->email)->send(new ProjectCreated($project)); // we will also send an email to the user with a message like "Hey your project has been created". With this part here 'new ProjectCreated($project))' we are creating a new mailable instance. <--because of this line here we must import our mail class: use Illuminate\Support\Facades\Mail;. Also, we must import our ProjectCreated class too: use App\Mail\ProjectCreated;
        });

    }

    
    public function owner(){
       return $this->belongsTo(User::class);// This here is a relationship. 1 project has one user. The project belongs to the user. (This is certainly not a hasMany relationship). If we run $project->owner, this will give us the project user.
    }






    public function tasks(){//this here is an Eloquent relationship. Relationships manage connections between db's, and also they can serve as QueryBuilders. What we are saying here: a project can have tasks.
    	return $this->hasMany(Task::class);//basically here we want to find out which tasks are belonging to a given project.
    }




    /*FOR SOME REASON THIS SHIT WAS REPLACED BY ANOTHER SHIT, FIND THAT NEW SHIT BELOW THIS SHIT
    public function addTask($description){//the $description is the task description typed in by the user.
    	$this->tasks()->create(compact('description'));//tasks() is possibly the tasks() method from above? Soo... create a new task with the given description. With this approach Laravel already knows the associated project. Laravel will apply the project id automatically. So we don't have to worry about the project_id number at all, and it is enough if we provide the description of the task.
    }*/
    public function addTask($task){//What we are saying here: a project can add a task.
    	$this->tasks()->create($task);
    }
}
