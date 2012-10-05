@layout('templates.main')

@section('content')
    <h1>{{$todo->title}}</h1>
    <p class="well">{{$todo->description}}</p>
    
    {{ Form::open('reports/create') }}

    @if ($errors->all())
        <ul>
        @foreach ($errors->all() as $banana)
            <li>{{$banana}}</li>
        @endforeach
        </ul>
    @endif

    <p>{{ Form::hidden('project_id', $todo->project_id) }}</p>
    <p>{{ Form::hidden('customer_id', $todo->customer_id) }}</p>

    <p>{{ Form::label('date', 'Datum') }}</p>
    {{ $errors->first('date', '<p class="error">:message</p>') }}
    <p>{{ Form::text('date', Input::old('date',date("Y-m-d"))) }}</p>

    <p>{{ Form::label('description', 'Beskrivning') }}</p>
    {{ $errors->first('description', '<p class="error">:message</p>') }}
    <p>{{ Form::textarea('description', Input::old('description')) }}</p>
    
    <p>{{ Form::label('time_spent', 'Tid ') }}</p>
    {{ $errors->first('time_spent', '<p class="error">:message</p>') }}
    <p>{{ Form::text('time_spent', Input::old('time_spent')) }}</p>

    <p>{{ Form::submit('Spara log',array('class'=>'btn')) }}</p>
    {{ Form::close() }}



    <table class="table">
    @foreach ($todo->reports as $report)
        <tr>
            <td>{{ $report->date }}</td>
            <td>{{ $report->description }}</td>
            <td>{{ $report->time_spent }}</td>
        </tr>
    @endforeach
    </table>

    {{ HTML::link_to_route('todos','Alla uppgifter')}}
@endsection