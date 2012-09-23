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
                                    <li>{{ HTML::link('admin', 'Login') }}</li>
                                @else
                                    <li>{{ HTML::link('report', 'Rapporter') }}</li>
                                    <li>{{ HTML::link('project', 'Project') }}</li>
                                    <li>{{ HTML::link('report/create', 'Logga tid') }}</li>
                                    <li>{{ HTML::link('logout', 'Logout') }}</li>
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
        