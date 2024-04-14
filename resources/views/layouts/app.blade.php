<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="/css/jquery-ui.css" />
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
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <div class="nav-item">
                    <img src="/css/images/旅游主题_地图.png" alt="Logo" width="100">
                </div>

                <div class="nav-item">
                    <form class="form-inline">
                        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                    </form>
                </div>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                        @guest

                            @if (Route::has('login'))
                                <div class="nav-link">
                                    <a href="{{ route('login') }}">
                                        <div class="nav-link">{{ __('Login') }}</div>
                                    </a>
                                </div>

                    @endif

                            @if (Route::has('register'))
                                <div class="nav-link">
                                    <a href="{{ route('register') }}">
                                        <div>{{ __('Register') }}</div>
                                    </a>
                                </div>
                            @endif
                        @else


                            <div class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-text dropdown-toggle" href="#" role="button"
                                   data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <div class="nav-text">{{ Auth::user()->name }}</div>
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
                            </div>
                        @endguest
            </div>
        </nav>
    </header>

    <main  class="container-fluid row">
        <aside class="col-2 bg-light sidebar">
            <div class="aside-item">
                <a href="/idea">
                    <div class="nav-text"><img src="/css/images/首页.png" alt="Idea List" >Idea List</div>
                </a>
            </div>

            @guest
                @if (Route::has('login'))
                @endif
                @if (Route::has('register'))
                @endif
            @else
                <div class="nav-item">
                    <a href="/idea/create">
                        <img src="/css/images/Add_idea.png" alt="New Idea" width="55">
                        <div class="nav-text">New Idea</div>
                    </a>
                </div>
            @endguest
        </aside>

        <div  role="main" class="col-10">
            @yield('content')
        </div>
    </main>

    <footer>
        <div style="text-align: center;">Copyright &copy; 2024 Travel Ideas</div>
    </footer>
</body>
</html>
