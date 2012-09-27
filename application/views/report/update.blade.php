@layout('templates.main')
@section('content')

    <h1>Redigera tidrapport</h1>

    {{ Form::open(URL::current()) }}

    @if ($errors->all())
        <ul class="alert">
            <strong>Nu blev något galet</strong> Titta i formuläret nedan så bör du ha förklaringen...
        </ul>
    @endif

    @include('report._form')

    {{ Form::hidden('report_id', $report->id) }}
    <p>{{ Form::submit('Update',array('class'=>'btn btn-primary')) }}</p>
    {{ Form::close() }}

@endsection