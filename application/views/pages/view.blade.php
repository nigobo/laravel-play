@layout('templates.main')
@section('content')
<div class="post">
<h1>{{ HTML::link('view/'.$post->id, $post->title) }}</h1>
<p>{{ $post->body }}</p>
<p>{{ HTML::link('/', '&larr; Back to index.') }}</p>
</div>
@endsection