<!DOCTYPE html>
<html>
<head>
	<title>@yield('title', 'PROJECTS')</title>
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.2/css/bulma.css">
	<style>
		.is-complete{
			text-decoration: line-through;
		}
	</style>
</head>
<body>

<h1 class="title">THE PROJECTS WEBPAGE</h1>
<h3>NAVBAR</h3>
	<ul class="list-group">
	    <li class="list-group-item"><a href="/home">Login/register</a></li>
	    <li class="list-group-item"><a href="/projects">Projects</a></li>
	    <li class="list-group-item"><a href="/example">Example</a></li>
	    <li class="list-group-item"><a href="/projects/create">Create new project</a></li>
	</ul>
<br>
<br>
<br>

	<div class="container">
		@yield('content')
	</div>

</body>
</html>