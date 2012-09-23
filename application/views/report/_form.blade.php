<div class="row">
    <div class="span6">
        <p>{{ Form::label('date', 'Date') }}</p>
        {{ $errors->first('date', '<p class="alert">:message</p>') }}
        <p>{{ Form::text('date', Input::old('date',$report->date)) }}</p>

        <p>{{ Form::label('project_id', 'Project') }}</p>
        {{ $errors->first('project_id', '<p class="alert">:message</p>') }}
        <p>{{ Form::select('project_id',$projects, Input::old('project_id',$report->project_id)) }}</p>

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