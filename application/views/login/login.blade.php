@layout('templates.main')
@section('content')

	<h1>Logga in</h1>
	{{ Form::open('login') }}

	@if (Session::has('login_errors'))
		<div class="alert">Username or password incorrect.</div>
	@endif

	<p>{{ Form::label('username', 'Username') }}</p>
	<p>{{ Form::text('username') }}</p>

	<p>{{ Form::label('password', 'Password') }}</p>
	<p>{{ Form::password('password') }}</p>

	<p>{{ Form::submit('Login',array('class'=>'btn')) }}</p>
	{{ Form::close() }}


@endsection