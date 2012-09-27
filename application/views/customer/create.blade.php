@layout('templates.main')
@section('content')

    <h1>Skapa kund</h1>
    {{ Form::open(URL::current()) }}

    @if ($errors->all())
        <ul>
        @foreach ($errors->all() as $banana)
            <li>{{$banana}}</li>
        @endforeach
        </ul>
    @endif

    <p>{{ Form::label('name', 'Namn') }}</p>
    {{ $errors->first('name', '<p class="error">:message</p>') }}
    <p>{{ Form::text('name', Input::old('name')) }}</p>

    <p>{{ Form::label('description', 'Beskrivning') }}</p>
    {{ $errors->first('description', '<p class="error">:message</p>') }}
    <p>{{ Form::textarea('description', Input::old('description')) }}</p>

    <p>{{ Form::submit('Skapa kund',array('class'=>'btn')) }}</p>
    {{ Form::close() }}

@endsection