@layout('templates.main')
@section('content')

    <h1>Skapa tidrapport</h1>

    {{ Form::open(URL::current()) }}

    @if ($errors->all())
        <ul class="alert">
            <strong>Nu blev något galet</strong> Titta i formuläret nedan så bör du ha förklaringen...
        </ul>
    @endif

    <div class="row">
        <div class="span6">

            {{ Form::hidden('todo_id', Input::old('todo_id',$todo->id)) }}
            {{ Form::hidden('customer_id', Input::old('customer_id',$todo->customer_id)) }}
            {{ Form::hidden('project_id', Input::old('project_id',$todo->project_id)) }}

            <p>{{ Form::label('date', 'Date') }}</p>
            {{ $errors->first('date', '<p class="alert">:message</p>') }}
            <p>{{ Form::text('date', Input::old('date',date("Y-m-d"))) }}</p>

            
            <p>{{ Form::label('time_spent', 'Time spent') }}</p>
            {{ $errors->first('time_spent', '<p class="alert">:message</p>') }}
            <p>{{ Form::text('time_spent', Input::old('time_spent')) }}</p>
        </div>
        <div class="span6">
            <p>{{ Form::label('description', 'Description') }}</p>
            {{ $errors->first('description', '<p class="alert">:message</p>') }}
            <p>{{ Form::textarea('description', Input::old('description')) }}</p>
        </div>
    </div>

    <p>{{ Form::submit('Create',array('class'=>'btn btn-primary')) }}</p>
    {{ Form::close() }}

@endsection