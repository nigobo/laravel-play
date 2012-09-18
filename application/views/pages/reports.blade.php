@layout('templates.main')

@section('content')
    @foreach ($reports as $report)
        <div class="post">
        <h1>{{ HTML::link('view/'.$report->id, $report->date) }}</h1>
        <p>{{ $report->description }}</p>
        <p>{{ $report->time_spent }}</p>
        <p>{{ HTML::link('view/'.$report->id, 'Read more &rarr;') }}</p>
        </div>
    @endforeach
@endsection