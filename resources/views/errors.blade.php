@if($errors->any())<!--this means: if there is error, do this...--> 
	<div class="notification is-danger"><!--ERROR DISPLAYING PART-->
		<ul>
			@foreach($errors->all() as $error)
				<li>{{ $error }}</li>
			@endforeach
		</ul>
	</div>
@endif