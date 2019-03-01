<?php

use Illuminate\Filesystem\Filesystem;




Route::get('/', function () {

    return view('welcome');//this leads to the Laravel default welcome page with the biig Laravel sign on it and the links...
});








Route::get('/example', 'ExampleController@index');//this is my testpage, where I replicate everyting what I learned from Jeff.




Route::resource('projects', 'ProjectsController');// with this, we have automatically created all seven necesary routes

Route::post('/projects/{project}/tasks', 'ProjectTasksController@store');//with this we are creating a new task. {project} is the id number of the project, that way Laravel will know where does belong the task, to which project.

Route::patch('/tasks/{task}', 'ProjectTasksController@update');// this is 'patch' because here we are actually updating the checkboxes...





/*
Route::get('/projects', 'ProjectsController@index');//shows all projects

Route::get('/projects/create', 'ProjectsController@create');//creates a project

Route::get('/projects/{project}', 'ProjectsController@show');//shows this peticuliar project. The {project} will be the number of the ID record.

Route::post('/projects', 'ProjectsController@store');//records this project to db

Route::get('/projects/{project}/edit', 'ProjectsController@edit');// This will edit a project. The {project} will be the number of the ID record.

Route::patch('/projects/{project}', 'ProjectsController@update');//This will update the project in the db after it has been edited

Route::delete('/projects/{project}', 'ProjectsController@destroy');//This will delete, destroy the record from the db.
*/









/* THESE ROUTES WERE CREATED BY THIS COMMAND: Route::resource('projects', 'ProjectsController');
+--------+-----------+-------------------------+------------------+-------------------------------------------------+--------------+
| Domain | Method    | URI                     | Name             | Action                                          | Middleware   |
+--------+-----------+-------------------------+------------------+-------------------------------------------------+--------------+
|        | GET|HEAD  | /                       |                  | Closure                                         | web          |
|        | GET|HEAD  | api/user                |                  | Closure                                         | api,auth:api |
|        | GET|HEAD  | example                 |                  | App\Http\Controllers\ExampleController@index    | web          |
|        | GET|HEAD  | projects                | projects.index   | App\Http\Controllers\ProjectsController@index   | web          |
|        | POST      | projects                | projects.store   | App\Http\Controllers\ProjectsController@store   | web          |
|        | GET|HEAD  | projects/create         | projects.create  | App\Http\Controllers\ProjectsController@create  | web          |
|        | GET|HEAD  | projects/{project}      | projects.show    | App\Http\Controllers\ProjectsController@show    | web          |
|        | PUT|PATCH | projects/{project}      | projects.update  | App\Http\Controllers\ProjectsController@update  | web          |
|        | DELETE    | projects/{project}      | projects.destroy | App\Http\Controllers\ProjectsController@destroy | web          |
|        | GET|HEAD  | projects/{project}/edit | projects.edit    | App\Http\Controllers\ProjectsController@edit    | web          |
+--------+-----------+-------------------------+------------------+-------------------------------------------------+--------------+
*/



Auth::routes();//this was created by the php artisan make:auth command

Route::get('/home', 'HomeController@index')->name('home');//this was created by the php artisan make:auth command
