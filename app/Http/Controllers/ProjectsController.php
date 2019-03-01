<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Project;//this was manually inserted!
use Illuminate\Filesystem\Filesystem;

class ProjectsController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }



    public function index(){
    	$id = auth()->id();//Losi solution for the admin autorization
        if ($id == 5) {//Losi solution for the admin autorization
            $projects = Project::all();//Losi solution for the admin autorization
        } else {//Losi solution for the admin autorization
            //$projects = Project::where('owner_id', $id)->get();//reminder: the Project.php is a model that we created. Here we are fetching  db records, and saving them in the $project variable. Jeff: where the owner id is = to the authenticated users id. Where is a conditional in Eloqent. All this is similar to "select * from projects where owner_id = 4"
            $projects = auth()->user()->projects;
        
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
    	
        $attributesValidated = request()->validate([
            'title' => ['required', 'min:3'],
            'description' => ['required', 'min:3']
        ]);//this part here is doing only the validation. The request() is getting the title and the description from the uri, and the validate() checks them. If the validation is OK, then we proceed with the new project creating in the db. Remeber, the title and the description are coming from the uri.

        $attributesValidated['owner_id'] = auth()->id();//here we adding another item to the $attributesValidated. But, this is not coming from the uri, so we must do it separatedly, like this. auth()-> id() will return an authenticated user id, example: 4.



        Project::create($attributesValidated);
    	return redirect('/projects');//redirect us back to /projects
    }


    public function edit(Project $project){
        return view('projects.edit', compact('project'));
    }//Reminder: we deifned the edit route like this: Route::get('/projects/{project}/edit', 'ProjectsController@edit');// This will edit a project. The {project} will be the number of the ID record, or the $id. Laravel is able to convert the {project} (aka whatever id number the user typed there) to the $id. We use the $id for db record finding.


    public function update(Project $project){
        $project->update(request(['title', 'description']));
        return redirect('/projects');
    }


    public function destroy(Project $project){
        $project->delete();
        return redirect('/projects');
    }
}
