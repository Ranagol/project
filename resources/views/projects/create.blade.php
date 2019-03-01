@extends('layout')


@section('content')

	<h1>Create a new project</h1>
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
			<button type="submit">Create project</button>
		</div>


		@include('errors')

	</form>

@endsection