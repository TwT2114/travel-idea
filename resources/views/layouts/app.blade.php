<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}@yield('title')</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Styles and Scripts -->
    <script src="/js/jquery.js"></script>
    <script src="/js/jquery-ui.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.31.3/js/jquery.tablesorter.min.js"></script>
    <link rel="stylesheet" href="/css/jquery-ui.css">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <link href="{{ asset('css/layout.css') }}" rel="stylesheet">

    @yield('script')

</head>
<body>
<header id="app" class="navbar navbar-expand-md navbar-light glass-container">
    <div class="container" style="position:sticky;top:0;">
        <img src="/css/images/旅游主题_地图.png" alt="Logo" width="100">
        <a class="navbar-brand" href="{{ url('/') }}">
            {{ config('app.name', 'Travel Idea') }}
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar. Search box-->
            <div class="navbar-nav me-auto">
                @guest
                @else
                    <div class="search-box">
                        <form class="form-inline" action="{{ route('idea.search') }}" method="GET"
                              style="display: flex;">
                            <input class="form-control mr-sm-2" type="text" name="searchTerm"
                                   placeholder="Search for ideas or plans... " style="width: 250px;">
                            <button class="btn btn-outline-success my-2 my-sm-0" type="submit"
                                    style="margin-left: 10px;">
                                Search
                            </button>
                        </form>
                    </div>
                @endguest
            </div>
            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ms-auto">

                <!-- Authentication Links -->
                @guest
                    @if (Route::has('login'))
                        <li class="header-item">
                            <a class="header-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                    @endif

                    @if (Route::has('register'))
                        <li class="header-item">
                            <a class="header-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                    <li class="header-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" role="button"
                           data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{ Auth::user()->name }}
                        </a>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
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
</header>


<div class="downContainer container-fluid row">
    @guest
    @else
        <aside>
            <nav class="col-2">
                <a class="nav-item" href="{{ route('idea.index') }}">
                    <div class="nav-text"><img src="/css/images/home.png" alt="Idea List">Idea List</div>
                </a>

                <a class="nav-item" href="{{ route('plan.index') }}">
                    <div class="nav-text"><img src="/css/images/PlanList.png" alt="Plan List">Plan List</div>
                </a>

                <a class="nav-item" href="{{ route('idea.create') }}">
                    <div class="nav-text"><img src="/css/images/new.png" alt="New Idea">New Idea</div>
                </a>
                <a class="nav-item" href="{{ route('plan.create') }}">
                    <div class="nav-text"><img src="/css/images/AddPlan.png" alt="New Plan">New Plan</div>
                </a>
                <a class="nav-item" href="{{ route('user.show', \Illuminate\Support\Facades\Auth::id()) }}">
                    <div class="nav-text"><img src="/css/images/user.png" alt="User">User</div>
                </a>


            </nav>
        </aside>
    @endguest
    <main class="col-10 main-container">
        <div class="message">
            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div><br/>
            @endif
        </div>
        @yield('content')
    </main>
</div>
<footer>
    <div>Copyright &copy; 2024 Travel Idea</div>
</footer>
</body>
</html>
