@extends('layout')

@section('content')

	<h1 class="title">Project title: {{ $project->title }}</h1>

	<div class="content">Project ID: {{ $project->id}}</div>

	<div class="content">Project description: {{ $project->description}}
		<p>
			<a href="/projects/{{ $project->id }}/edit">Edit project title or description</a>
		</p>
	</div>

<!--TASKS LIST-->
	@if($project->tasks->count())<!--If there is at least one task, so the count() functions counting can result at least with 1, then...-->
		<div class="box">
			<h3 class="title">Our tasks for this project are:</h3>
				
				@foreach($project->tasks as $task)
					<div>
						<form method="POST" action="/tasks/{{ $task->id }}">
							@method('PATCH')<!--here we are faking the PATCH method-->
							
							@csrf<!--this is the mandatory csrf token generating security item, it is a MUST!-->
							
							<label class="checkbox {{ $task->completed ? 'is-complete' : ''}}" for="completed"><!--OK, so what we are saying here: if the task is completed, print out an is-complete attribute. This is-complete attribute will be used as a css class to format the completed task, to make it crosslined-->
								
								<input type="checkbox" name="completed" onChange="this.form.submit()" {{ $task->completed ? 'checked' : ''}}> <!--Ok, so what we are saying here: if the task is completed, then print out checked (which will be an attribute, that will make the given checkbox checked. And if the task is not completed, then print out nothing, which obviously won't change the status of the checkbox. -->
									
									{{ $task->description }}<!--print out this task description please...-->
							</label>
						</form>
					</div>
				@endforeach
		</div>
	@endif



<!--CREATE A NEW TASK-->
<form method="POST" action="/projects/{{ $project->id }}/tasks" class="box">
	@csrf
	<div class="field" >
		<label class="label" for="description">New task</label>
		<div class="control">
			<input type="text" class="input" name="description" placeholder="New task" required="">
		</div>
	</div>

	<div class="field">
		<div class="control">
			<button type="submit" class="button is-link">Add task</button>
		</div>
	</div>

<!--THIS PART IS FOR THE VALIDATION ERROR DISPLAYING-->
	@include('errors')
</form>

@endsection