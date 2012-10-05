<div class="row">
    <div class="span6">

        {{ Form::hidden('todo_id', Input::old('todo_id',$report->todo_id)) }}
        {{ Form::hidden('project_id', Input::old('project_id',$report->project_id)) }}

        <p>{{ Form::label('date', 'Date') }}</p>
        {{ $errors->first('date', '<p class="alert">:message</p>') }}
        <p>{{ Form::text('date', Input::old('date',$report->date)) }}</p>

        
        <p>{{ Form::label('time_spent', 'Time spent') }}</p>
        {{ $errors->first('time_spent', '<p class="alert">:message</p>') }}
        <p>{{ Form::text('time_spent', Input::old('time_spent',$report->time_spent)) }}</p>
    </div>
    <div class="span6">
        <p>{{ Form::label('description', 'Description') }}</p>
        {{ $errors->first('description', '<p class="alert">:message</p>') }}
        <p>{{ Form::textarea('description', Input::old('description',$report->description)) }}</p>
    </div>
</div>