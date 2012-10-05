@layout('templates.main')
@section('content')

    <h1>{{$customer->name}}</h1>
    <p>{{$customer->description}}</p>

    <hr/>
    {{ HTML::link_to_route('create_project','Skapa projekt',array($customer->id),array('class'=>'btn'))}}
    <hr/>


    <div class="row-fluid">
        <div class="span6">
            <h2>Projekt</h2>

            <table class="table table-condensed table-striped table-bordered">
            @forelse ($customer->projects as $project)
                <tr>
                    <td>
                        {{ HTML::link_to_route('read_project',$project->name,array($project->id))}}
                    </td>
                    <td>
                        {{ $project->todos()->count() }}
                    </td>
                    <td>
                        {{ HTML::link_to_route('create_todo','Skapa uppgift',array($project->id),array('class'=>'btn btn-mini')) }}
                    </td>
                </tr>
            @empty
                <tr>
                    <td>
                        <div class="alert">Här finns det inga projekt</div>
                    </td>
                </tr>
            @endforelse
            </table>
        </div>
        <div class="span6">
            <h2>Tasks</h2>
            <table class="table table-condensed table-striped table-bordered">
            @forelse ($customer->todos as $todo)
                <tr>
                    <td>
                        {{$todo->project->name}}
                    </td>
                    <td>
                        {{ HTML::link_to_route('read_todo',$todo->title,array($todo->id))}}
                    </td>
                    <td>
                        {{ $todo->reports()->sum('time_spent') }}
                        {{ HTML::link_to_route('create_report','+',array($todo->id))}}
                    </td>
                </tr>
            @empty
                <tr>
                    <td>
                        <div class="alert">Här finns det inga uppgifter att göra</div>
                    </td>
                </tr>
                
            @endforelse
            </table>

        </div>
    </div>



@endsection