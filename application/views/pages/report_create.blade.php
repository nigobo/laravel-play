@layout('templates.main')
@section('content')

    {{ Form::open('report/create') }}

    @if ($errors->all())
        <ul>
        @foreach ($errors->all() as $banana)
            <li>{{$banana}}</li>
        @endforeach
        </ul>
    @endif

    <p>{{ Form::label('date', 'Date') }}</p>
    {{ $errors->first('date', '<p class="error">:message</p>') }}
    <p>{{ Form::text('date', Input::old('date')) }}</p>

    <p>{{ Form::label('time_spent', 'Time spent') }}</p>
    {{ $errors->first('time_spent', '<p class="error">:message</p>') }}
    <p>{{ Form::text('time_spent', Input::old('time_spent')) }}</p>

    <p>{{ Form::label('description', 'Description') }}</p>
    {{ $errors->first('description', '<p class="error">:message</p>') }}
    <p>{{ Form::textarea('description', Input::old('description')) }}</p>

    <p>{{ Form::submit('Create') }}</p>
    {{ Form::close() }}

@endsection