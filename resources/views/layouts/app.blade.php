<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="/css/jquery-ui.css"/>
    <script src="/js/jquery.js"></script>
    <script src="/js/jquery-ui.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Styles and Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <link href="{{ asset('css/layout.css') }}" rel="stylesheet">

    @yield('script')

</head>
<body>
<header id="app">
    <nav class="navbar navbar-expand-md navbar-light glass-container">
        <div class="container" style="position:sticky;top:0;">
            <img src="/css/images/旅游主题_地图.png" alt="Logo" width="100">
            <a class="navbar-brand" href="{{ url('/') }}">
                {{ config('app.name', 'Travel Genius') }}
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <div class="navbar-nav me-auto">
                    @guest
                    @else
                        <div class="search-box">
                            <form class="form-inline" action="{{ route('idea.search') }}" method="GET"
                                  style="display: flex;">
                                <input class="form-control mr-sm-2" type="text" name="searchTerm"
                                       placeholder="Search for destination or tags... " style="width: 250px;">
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
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                               data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
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
    </nav>
</header>

<main class="container-fluid row">
    @guest
    @else
        <aside class="col-2">
            <a class="aside-item" href="{{ route('idea.index') }}">
                <div class="aside-text"><img src="/css/images/home.png" alt="Idea List">Idea List</div>
            </a>

            <a class="aside-item" href="{{ route('plan.index') }}">
                <div class="aside-text"><img src="/css/images/PlanList.png" alt="Plan List">Plan List</div>
            </a>

            <a class="aside-item" href="{{ route('idea.create') }}">
                <div class="aside-text"><img src="/css/images/new.png" alt="New Idea">New Idea</div>
            </a>
            <a class="aside-item" href="{{ route('plan.create') }}">
                <div class="aside-text"><img src="/css/images/AddPlan.png" alt="New Plan">New Plan</div>
            </a>
            <a class="aside-item" href="{{ route('user.show', \Illuminate\Support\Facades\Auth::id()) }}">
                <div class="aside-text"><img src="/css/images/user.png" alt="User">User</div>
            </a>

            @endguest
        </aside>

        <div role="main" class="col-10 main-container">
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
        </div>
</main>
<footer>
    <div>Copyright &copy; 2024 Travel Idea</div>
</footer>
</body>
</html>
