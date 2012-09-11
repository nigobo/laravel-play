@layout('templates.main')
@section('content')

    {{ Form::open('admin') }}

    <p>{{ Form::label('title', 'Title') }}</p>
    {{ $errors->first('title', '<p class="error">:message</p>') }}
    <p>{{ Form::text('author_id', $user->id) }}</p>
    <p>{{ Form::text('title', Input::old('title')) }}</p>

    <p>{{ Form::label('body', 'Body') }}</p>
    {{ $errors->first('body', '<p class="error">:message</p>') }}
    <p>{{ Form::textarea('body', Input::old('body')) }}</p>

    <p>{{ Form::submit('Create') }}</p>
    {{ Form::close() }}

@endsection