<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Project;//this was manually inserted!
use Illuminate\Filesystem\Filesystem;
use App\Mail\ProjectCreated;


class ProjectsController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }



    public function index(){
    	$id = auth()->id();//Losi 
        if ($id == 5) {//Losi 
            $projects = Project::all();//Losi 
        } else {//Losi solution. If the user is admin (admin is id=5), then show him all the project. In every other case...
           
            $projects = auth()->user()->projects;//what we are saying here: whoever signed in, give me his projects. project() is a method from User.php, and kill me if I know why the fuck it does not need the ().
        
        }
    	return view('projects.index', compact('projects'));
    } 


    public function show(Project $project){//Project is the model that we created, and it fetches data from db. Laravel reads the wild card id number from the uri, where the user is. (example: http://127.0.0.1:8000/projects/2----- so, the id number is 2). So Laravel here puts all this together, and assumes that we want to fetch data for id number 2, into the $project variable. This part here (Project $project) is called route model binding.
        
        $this->authorize('update', $project);//any controller can acces the authorize() method. Here we want to check if the user is authorized to view() the given $project. When we are calling authorize, we are basically saying: reference the necesarry policy class, then call the update() method from ProjectPolicy.php while sending through the $project. Now, there are a lot of ways to authorize, but Jeff recomends this way.
        
        return view('projects.show', compact('project'));
    }


    public function create(){
    	return view('projects.create');
    }




    public function store(){
    	
        $attributesValidated = $this->validateProject();//this part is validating the title and the description from the uri. The validateProject() method is also in this file, at the bottom.

        $attributesValidated['owner_id'] = auth()->id();//here we are adding another item to the $attributesValidated. But, this is not coming from the uri, so we must do it separatedly, like this. auth()-> id() will return an authenticated user id, example: 4.

        $project = Project::create($attributesValidated);//create this project title and project description in the db.

        \Mail::to($project->owner->email)->send( new ProjectCreated($project)); // we will also send an email to the user with a message like "Hey your project has been created". With this part here 'new ProjectCreated($project))' we are creating a new mailable instance.

    	return redirect('/projects');//redirect us back to /projects
    }


    public function edit(Project $project){
        return view('projects.edit', compact('project'));
    }//Reminder: we deifned the edit route like this: Route::get('/projects/{project}/edit', 'ProjectsController@edit');// This will edit a project. The {project} will be the number of the ID record, or the $id. Laravel is able to convert the {project} (aka whatever id number the user typed there) to the $id. We use the $id for db record finding.



    public function update(Project $project){
        
        $project->update($this->validateProject());
        return redirect('/projects');
    }





    public function destroy(Project $project){
        $project->delete();
        return redirect('/projects');
    }


    protected function validateProject(){
        return request()->validate([
            'title' => ['required', 'min:3'],
            'description' => ['required', 'min:3']
        ]);
    }



}
