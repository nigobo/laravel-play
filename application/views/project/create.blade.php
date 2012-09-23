@layout('templates.main')
@section('content')

    <h1>Skapa projekt</h1>
    {{ Form::open('project/create') }}

    @if ($errors->all())
        <ul>
        @foreach ($errors->all() as $banana)
            <li>{{$banana}}</li>
        @endforeach
        </ul>
    @endif

    <p>{{ Form::label('name', 'Name') }}</p>
    {{ $errors->first('name', '<p class="error">:message</p>') }}
    <p>{{ Form::text('name', Input::old('name')) }}</p>

    <p>{{ Form::label('description', 'Description') }}</p>
    {{ $errors->first('description', '<p class="error">:message</p>') }}
    <p>{{ Form::textarea('description', Input::old('description')) }}</p>

    <p>{{ Form::submit('Create project') }}</p>
    {{ Form::close() }}

@endsection