<!DOCTYPE HTML>
<html lang="en-GB">
    <head>
        <meta charset="UTF-8">
        <title>BinaryBrick</title>
        {{ HTML::style('media/css/bootstrap.min.css') }}
        {{ HTML::style('css/style.css') }}
        
    </head>
    <body>
        <div class="header">
            @if ( Auth::guest() )
                {{ HTML::link('admin', 'Login') }}
            @else
                {{ HTML::link('', 'home') }}
                {{ HTML::link('report/create', 'Logga tid') }}
                {{ HTML::link('logout', 'Logout') }}
            @endif
            <hr />
            <h1>Wordpush</h1>
            <h2>Code is Limmericks</h2>
        </div>
        <div class="content">
            @yield('content')
        </div>
    </body>
</html>