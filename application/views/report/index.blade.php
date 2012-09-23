@layout('templates.main')

@section('content')
    <h1>Alla rapporter</h1>
    <table class="table table-striped table-condensed">
        <tr class="post">
            <th>Datum</th>
            <th>Vad</th>
            <th>Projekt</th> 
            <th>Tid</th>
            <th>Id</th>
        </tr>
    @foreach ($reports->results as $report)
        <tr class="post">
            <td>{{ HTML::link_to_route('update_report', substr($report->date,0,10), $report->id) }}</td>
            <td>{{ $report->description }}</td>
            <td>{{ $report->project->name }}</td>
            
            <td>{{ $report->time_spent }}</td>
            <td>{{ $report->id }}</td>
        </tr>
    @endforeach
    </table>
    {{ $reports->links() }}
@endsection