@layout('templates.main')
@section('content')

    <h1>Skapa uppgift</h1>

    {{ Form::open('todos/create') }}

    @if ($errors->all())
        <ul class="alert">
            <strong>Nu blev något galet</strong> Titta i formuläret nedan så bör du ha förklaringen...
        </ul>
    @endif

    @include('todo._form')
    
    <p>{{ Form::submit('Skapa',array('class'=>'btn btn-primary')) }}</p>
    {{ Form::close() }}

@endsection