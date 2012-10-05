
@if ($errors->all())
    <ul>
    @foreach ($errors->all() as $banana)
        <li>{{$banana}}</li>
    @endforeach
    </ul>
@endif

<p>{{ Form::hidden('project_id', $project->id) }}</p>
<p>{{ Form::hidden('customer_id', $project->customer_id) }}</p>

<p>{{ Form::label('title', 'Titel') }}</p>
{{ $errors->first('title', '<p class="error">:message</p>') }}
<p>{{ Form::text('title', Input::old('title')) }}</p>

<p>{{ Form::label('description', 'Beskrivning') }}</p>
{{ $errors->first('description', '<p class="error">:message</p>') }}
<p>{{ Form::textarea('description', Input::old('description')) }}</p>

