<?php

namespace App\Listeners;

use App\Mail\ProjectCreated as ProjectCreatedMail;
use App\Events\ProjectCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendProjectCreatedNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  ProjectCreated  $event
     * @return void
     */
    public function handle(ProjectCreated $event)
    {
        Mail::to($event->$project->owner->email)->send(new ProjectCreatedMail($event->$project)); // we will also send an email to the user with a message like "Hey your project has been created". With this part here 'new ProjectCreated($project))' we are creating a new mailable instance. This was typed in the top section: use App\Mail\ProjectCreated as ProjectCreatedMail;
    }
}
