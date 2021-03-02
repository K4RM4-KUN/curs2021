<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        .showButton{
            padding: 5px;
            width:33%;
            text-decoration:none;
            border: 1px solid black;
            background-color: orange;
            color: black;
        }
        .editButton{
            padding: 5px;
            width:33%;
            text-decoration:none;
            border: 1px solid black;
            background-color: orange;
            color: black;
        }
        .mt-5{
            margin:8px;
        }
        .addButton{
            padding: 5px;
            width:33%;
            text-decoration:none;
            border: 1px solid black;
            background-color: orange;
            color: black;
            margin: 5px;
        }
        .buttonAddSection{
            width:190px;
            background-color: black;
            text-align: center;
        }
        .backButton{
            padding: 5px;
            text-decoration:none;
            border: 1px solid black;
            background-color: orange;
            color: black;
            margin: 5px;
        }
        .showContent{
            color: orange;
            border: 1px solid orange;
            margin: 3px;
        }
        .showContent label{
            font-weight: bold;
        }
        .content{
            display: flex;
            background-color: black;
        }
        .saveButton{
            padding: 5px;
            text-decoration:none;
            border: 1px solid black;
            background-color: orange;
            color: black;
            margin: 5px;
        }
        .cancelButton{
            padding: 5px;
            text-decoration:none;
            border: 1px solid black;
            background-color: orange;
            color: black;
            margin: 5px;
        }
        .addText{
            width:180px;
            padding: 5px;
            background-color: black;
            color: orange;
        }
        .deleteButton{
            padding: 5px;
            width:33%;
            text-decoration:none;
            background-color: orange;
        }
        td{
            text-align:center;
            width:25%;
            color: orange;
            background-color: black;
        }
        th{
            text-align:center;
            width:25%;
            color: orange;
            background-color: black;
        }
    </style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif
                            
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
