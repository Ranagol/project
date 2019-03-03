@extends('layout')

@section('content')
	<h1 class="title">Edit project</h1>


<form method="POST" action="/projects/{{ $project->id }}" style="margin-bottom: 1em;">
	{{ method_field('PATCH')}} <!--This is the trick where we say to Laravel: although this is a post method, please use it as a patch method. This will create a hidden input for the server-->
	{{ csrf_field() }}<!--whenever you have a form in Laravel, you must add this csrf field! It won't work without this-->


	<div class="field">
		<label class="label" for="title">Title</label>
		<div class="control">
			<input type="text" class="input" name="title" placeholder="Title" value="{{ $project->title}}">
		</div>
	</div>


	<div class="field">
		<label class="label" for="description">Description</label>
		<div class="control">
			<textarea name="description" class="textarea">{{ $project->description}}</textarea>
		</div>
	</div>

	<!--THE UPDATE BUTTON-->
	<div class="field">
		<div class="control">
			<button type="submit" class="button is-link">Update project</button>
		</div>
	</div>
</form>

@include('errors')

<!--THE DELETE BUTTON-->
<form method="POST" action="/projects/{{ $project->id }}">
	@method('DELETE')<!--Here we are faking a delete method... This is = {{ method_field('DELETE')}}-->
	@csrf<!--this is the csrf security check, = {{ csrf_field() }}-->
	<div class="field">
		<div class="control">
			<button type="submit" class="button">Delete project</button>
		</div>
		
	</div>
</form>




@endsection