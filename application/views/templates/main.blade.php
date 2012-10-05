<!DOCTYPE HTML>
<html lang="en-GB">
    <head>
        <meta charset="UTF-8">
        <title>BinaryBrick</title>
       
        {{ Asset::styles() }}
        {{ Asset::scripts() }}
        
    </head>
    <body>
        <div class="navbar navbar-fixed-top">
            <div class="navbar-inner">
                <div class="container">
                    <a class="brand" href="/">BinaryBrick</a>
                    <div class="nav-collapse">
                        <ul class="nav">
                            @section('navigation')
                                <li>{{ HTML::link('', 'Home') }}</li>
                                @if ( Auth::guest() )
                                    <li>{{ HTML::link_to_route('login', 'Login') }}</li>
                                @else
                                    <li>{{ HTML::link_to_route('customers', 'Kunder') }}</li>
                                    <li>{{ HTML::link_to_route('projects', 'Projekt') }}</li>
                                    <li>{{ HTML::link_to_route('todos', 'Uppgifter') }}</li>
                                    <li>{{ HTML::link_to_route('reports', 'Rapporter') }}</li>
                                    <li>{{ HTML::link_to_route('create_report', 'Rapportera') }}</li>
                                    <li>{{ HTML::link_to_route('logout', 'Logga ut') }}</li>
                                @endif
                            @yield_section
                        </ul>
                    </div><!--/.nav-collapse -->
                </div>
            </div>
        </div>
        <div class="container">
            @yield('content')
            <hr>
            <footer>
            <p>&copy; BinaryBrick 2012</p>
            </footer>
        </div> <!-- /container -->
        