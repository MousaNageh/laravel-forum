<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    @yield('css')
    <link href="{{ asset('css/app.css') }}" rel="stylesheet"> 

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
                        @auth
                        <li class="nav-item">
                            <a href="{{ route("notifications.read")}}" class="nav-link text-decoration-none badge badge-danger" style="color: #fff">{{ auth()->user()->unreadNotifications()->count()  }} notifications</a>
                        </li>
                        @endauth 
                        <li class="nav-item">
                            <a href="/discussion" class="nav-link" >Discussions</a>
                        </li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <img src="{{ Gravatar::src(auth()->user()->email)}}" alt="notfound" style="width: 40px ; height: 40px; border-radius: 50%">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                    
                                </a>
                                
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        @auth
        @if (session()->has("failed"))
                        <div class="container">
                            <div class="alert alert-danger">
                                {{ session()->get("failed") }}
                            </div>
                        </div>
                @endif
        <div class="container">
            <main class="py-4">
                
                <div class="row">
                    <div class="col-md-4"> 
                        <a href="{{route("discussion.create")}}" class="btn btn-info my-2" style="width: 100%; color:#FFF">create discussion </a>
                        <div class="card card-default">
                            <div class="card-header"><h3>channels</h3></div>
                            <div class="card-bod">
                                <ul class="list-group">
                                    @foreach ($channels as $channel)
                                        <li class="list-group-item">
                                            <a href="{{route("discussion.index")}}?channel={{$channel->slug}}" class="text-decoration-none">
                                                {{ $channel->name }}
                                            </a>
                                            
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8"> 
                        @if ($errors->any()) 
                        <ul class="list-group">
                            @foreach ($errors->all() as $error)
                            <li class="list-group-item alert alert-danger">{{$error}}</li>
                            @endforeach
                            
                        </ul>
                            
                        @endif 
                        @if (session()->has("success"))
                            <div class="alert alert-success">
                                {{ session()->get("success") }}
                            </div>
                        @endif
                        
                        @yield('content')
                    </div>
                </div>
                
            </main>
        </div>
        @else 
            @if (in_array(request()->path(),[
                "login" , 
                "password/confirm", 
                "password/email" ,
                "password/reset" , 
                "register" 
            ]))
                <div class="container">
                    <main class="my-5">
                        @yield('content')
                    </main>
                </div>
            @else
            <div class="container">
                <main class="py-4">
                    <div class="row">
                        <div class="col-md-4"> 
                            <a href="{{ route('login') }}" class="btn btn-info my-2" style="width: 100%; color:#FFF">sign in to add discussion </a>
                            <div class="card card-default">
                                <div class="card-header"><h3>channels</h3></div>
                                <div class="card-bod">
                                    <ul class="list-group">
                                        @foreach ($channels as $channel)
                                            <li class="list-group-item">
                                                <a href="{{route("discussion.index")}}?channel={{$channel->slug}}" class="text-decoration-none">
                                                    {{ $channel->name }}
                                                </a>
                                                
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8">
                            @yield('content')
                        </div>
                    </div>
                    
                </main>
            </div>
            @endif
        
        @endauth
        
    </div>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script> 
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    @yield('js')
</body>
</html>
