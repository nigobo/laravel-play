@layout('templates.main')
@section('content')

    <h1>Skapa projekt</h1>
    {{ Form::open(URL::current()) }}

    @if ($errors->all())
        <ul>
        @foreach ($errors->all() as $banana)
            <li>{{$banana}}</li>
        @endforeach
        </ul>
    @endif

    {{ Form::hidden('customer_id',$customer->id) }}


    <p>{{ Form::label('name', 'Namn') }}</p>
    {{ $errors->first('name', '<p class="error">:message</p>') }}
    <p>{{ Form::text('name', Input::old('name')) }}</p>

    <p>{{ Form::label('hour_rate', 'Timpris') }}</p>
    {{ $errors->first('hour_rate', '<p class="error">:message</p>') }}
    <p>{{ Form::text('hour_rate', Input::old('hour_rate')) }}</p>

    <p>{{ Form::label('description', 'Beskrivning') }}</p>
    {{ $errors->first('description', '<p class="error">:message</p>') }}
    <p>{{ Form::textarea('description', Input::old('description')) }}</p>

    <p>{{ Form::submit('Skapa projekt',array('class'=>'btn')) }}</p>
    {{ Form::close() }}

@endsection