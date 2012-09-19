@layout('templates.main')

@section('content')
    <table>
    @foreach ($reports as $report)
        <tr class="post">
        <td>{{ HTML::link('view/'.$report->id, $report->date) }}</td>
        <td>{{ $report->description }}</td>
        <td>{{ $report->time_spent }}</td>
        </tr>
    @endforeach
    </table>
@endsection