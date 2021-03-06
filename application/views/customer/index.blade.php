@layout('templates.main')

@section('content')
    <h1>Alla kunder</h1>
    <table class="table table-striped table-condensed">
        <tr class="post">
            <th>Namn/beskrivning</th>
            <th>Projekt</th> 
        </tr>
    @foreach ($customers as $c)
        <tr class="post">
            <td>
                {{ HTML::link_to_route('read_customer',$c->name,array($c->id))}}<br/>
                {{ $c->description }}
            </td>
            <td>
                @foreach ($c->projects as $p)
                    {{$p->name}}<br>
                @endforeach
            </td>
        </tr>
    @endforeach
    </table>
    {{ HTML::link_to_route('create_customer','Skapa ny kund','',array('class'=>'btn'))}}
@endsection