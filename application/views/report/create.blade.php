@layout('templates.main')
@section('content')

    <h1>Skapa tidrapport</h1>

    {{ Form::open('report/create') }}

    @if ($errors->all())
        <ul class="alert">
            <strong>Nu blev något galet</strong> Titta i formuläret nedan så bör du ha förklaringen...
        </ul>
    @endif

    @include('report._form')
    
    <p>{{ Form::submit('Create',array('class'=>'btn btn-primary')) }}</p>
    {{ Form::close() }}

@endsection