@layout('templates.main')

@section('content')
    <h1>Alla projekt</h1>
    <table class="table table-striped table-condensed">
    @foreach ($projects as $p)
        <tr class="post">
            <td>{{ HTML::link('project/view/'.$p->id,$p->name) }}</td>
            <td>{{ $p->description }}</td>
        </tr>
    @endforeach
    </table>
    {{ HTML::link('project/create','Skapa projekt')}}
@endsection