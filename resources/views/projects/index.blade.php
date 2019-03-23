@extends('layout')

@section('content')
<p>
	<h3 class="title">Projects</h3>
</p>
<p>
	You can edit or delete your projects by clicking on it.
</p>
	

	<ul>
		@foreach($projects as $project)
			<li>
				<a href="/projects/{{ $project->id }}">{{ $project->title}}
				</a>
			</li>
		@endforeach
	</ul>
	

@endsection
