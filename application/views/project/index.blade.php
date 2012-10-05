@layout('templates.main')

@section('content')
    <h1>Alla projekt</h1>
    <table class="table table-striped table-condensed">
    @foreach ($projects as $p)
        <tr class="post">
            <td>{{ HTML::link_to_route('read_project',$p->name,array($p->id)) }}</td>
            <td>{{ $p->description }}</td>
            <td>{{ HTML::link_to_route('create_todo','Skapa uppgift',array($p->id)) }}</td>
        </tr>
    @endforeach
    </table>
    {{ HTML::link_to_route('create_project','Skapa projekt')}}
@endsection