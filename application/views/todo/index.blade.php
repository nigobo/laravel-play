@layout('templates.main')

@section('content')
    <h1>Alla uppgifter</h1>
    <table class="table table-striped table-condensed">
        <tr>
            <th>Vad</th>
            <th>Beskrivning</th>
            <th>Tid</th>
        </tr>
    @foreach ($todos as $t)
        <tr class="post">
            <td>{{ HTML::link_to_route('read_todo',$t->title,array($t->id)) }}</td>
            <td>{{ $t->description }}</td>
            <td>{{ $t->reports()->sum('time_spent') }}</td>
        </tr>
    @endforeach
    </table>
    {{ HTML::link_to_route('create_todo','Skapa uppgift','',array('class'=>'btn'))}}
@endsection