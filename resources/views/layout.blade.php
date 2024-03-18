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
        <nav class="value">
            <table>
                <tr>
                    <td><a href=" "><img src=" " alt="MyIdea" width=" "></a></td>
                    <td><a href=" "><img src=" " alt="NewIdea" width=" "></a></td>
                    <td><a href=" "><img src=" " alt="Favorite" width=" "></a></td>
                    <td><a href=" "><img src=" " alt="Logout" width=" "></a></td>
                </tr>
            </table>
            <div class="search-container">
                <input type="text" id="searchInput" placeholder="Enter search term...">
                <select id="searchType">
                    <option value="destination">Destination</option>
                    <option value="tag">Tag</option>
                </select>
                <button onclick="search()">Search</button>
            </div>
        </nav>
    </header>

    <article>
        <div class="container">
        @yield('content')
        </div>
    </article>
    <script src="{{ asset('js/app.js') }}"></script>
    <footer>2024 Teavel Ideas Website </footer>
</body>

<!-- Search jQurey -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    function search() {
        var searchType = $('#searchType').val();
        var searchTerm = $('#searchInput').val();

        if (searchType === 'destination') {
            // Send AJAX request to search by destination
            $.ajax({
                method: 'GET',
                url: '/searchByDestination',
                data: { searchTerm: searchTerm },
                success: function(response) {
                    // Handle and display search results
                }
            });
        } else if (searchType === 'tag') {
            // Send AJAX request to search by tag
            $.ajax({
                method: 'GET',
                url: '/searchByTag',
                data: { searchTerm: searchTerm },
                success: function(response) {
                    // Handle and display search results
                }
            });
        }
    }
</script>

</html>

