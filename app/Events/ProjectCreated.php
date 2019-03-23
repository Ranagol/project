<?php

namespace App\Events;


use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;


class ProjectCreated
{
    use Dispatchable, SerializesModels;
    

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public $project;
    public function __construct($project)//here we are including the just created new project into the argument, but I think this here is just a placeholder. The new project creation just happened in the ProjectsController.php in the store().
    {
        $this->project = $project;
    }

    
}
