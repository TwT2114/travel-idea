<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <link href=" " rel="stylesheet">
</head>
<body>
    <header>
        <nav>

        </nav>
    </header>

    <article>
        <div class="container">
        @yield('content')
    </article>
    <script src="{{ asset('js/app.js') }}"></script>
    <footer>2024 Teavel Ideas Website </footer>
</body>
</html>

