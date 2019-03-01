<?php

namespace App\Policies;

use App\User;
use App\Project;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProjectPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the project.
     *
     * @param  \App\User  $user
     * @param  \App\Project  $project
     * @return mixed
     */
    public function update(User $user, Project $project)//so, now we are checking if this authenticated $user has permission to view this $project. The logic of whether a user can view, update, delete a project is all the same. Because of that, we need only one method for view, update, delete... So, we will change this method from view() name to update() name. And we will use only this one method.
    {
        return $project->owner_id == $user->id;//...check the owner_id of the project, and see if that is = to the authenticated user id
    }
}
    