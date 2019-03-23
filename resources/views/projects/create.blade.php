@extends('layout')


@section('content')

	<h3>Create a new project</h3>
	<br>
	<form method="POST" action="/projects">

		{{ csrf_field() }}

		<div>
			<input type="text" class="input {{ $errors->has('title') ? 'is-danger' : ''}}" name="title" value="{{ old('title') }}" placeholder="Project title">
		</div>
		<br>


		<div>
			<textarea name="description" class="textarea {{ $errors->has('title') ? 'is-danger' : ''}}" value="{{ old('description') }}" placeholder="Project description"></textarea>
		</div>
		<br>


		<div>
			<button class="btn btn-success" type="submit">Create project</button>
		</div>


		@include('errors')

	</form>

@endsection