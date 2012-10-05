@layout('templates.main')

@section('content')
    <h1>{{$project->name}}</h1>
    

    <table class="table">
    @foreach ($project->reports as $report)
        <tr>
            <td>{{ $report->date }}</td>
            <td>{{ $report->description }}</td>
            <td>{{ $report->time_spent }}</td>
        </tr>
    @endforeach
    </table>

    <hr />
    {{ HTML::link_to_route('projects','Alla projekt')}}
@endsection