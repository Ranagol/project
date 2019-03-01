<?php

namespace App\Providers;

//use Illuminate\Support\Facades\Gate;
use Illuminate\Contracts\Auth\Access\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Project' => 'App\Policies\ProjectPolicy',//the App\Project Eloquent model will map to the ProjectPolicy. (So now Laravel knows: for this Eloqent model this is the associated policy)
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */

    
    
    
    public function boot(Gate $gate)//here we will autoinject Laravels's gate class
    {
        $this->registerPolicies();//possibly we are registering our Gate thingy here???

        $gate->before(function ($user){//and here we are registering a before hook. Before we trigger any of the logic in the ProjectPolicy, Laravel will first trigger this before hook. So, this is a good place to add logic and permissions, that superseed everything else in our system. Example, this is a good place to put our administrator...
            
            /*return $user->id == 5;//THIS HERE IS THE ORIGINAL CODE FROM LARACAST-not working at all + users can't see their own projects*/

            /*THIS WAS SUGGESTED IN THE COMMENTS... this is not working either, but at least all the users can CRUD their projects...*/
            if ($user->id == 5) {//(we just made this guy the admin, he has now right to see all projects)
                
                return true;//so what we did here. BEFORE auth operations, check the user id. If the user id is 2, than don't run the auth processes, and allow this person to see, edit, delete everything and everybodies projects.
            }
        });
    }
}
