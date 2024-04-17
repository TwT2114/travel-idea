@extends('layouts.app')

@section('script')
    <script src="{{ asset('js/favorites.js') }}"></script>
    <link rel="stylesheet" type="text/css" href="/css/zebra.css"/>

    <script>
        $(function() {
            $("#idea-list").tablesorter();
        });
    </script>

@endsection

@section('content')
    <div>
        <article><h1>Idea List</h1></article>
        Click the table header to sort
        <table id="idea-list" class="table table-hover zebra border-header">
            <thead class="plan-header">
            <tr>
                <th>User</th>
                <th>Title</th>
                <th>Destination</th>
                <th>Tags</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th></th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach($ideas as $key => $idea)
                <tr>
                    <td><a href="{{ route('user.show', $idea->user_id) }}">{{ $idea->user_name }}</a></td>
                    <td>{{ $idea->title }}</td>
                    <td>{{ $idea->destination }}</td>
                    <td>{{ $idea->tags }}</td>
                    <td>{{ $idea->start_date }}</td>
                    <td>{{ $idea->end_date }}</td>
                    <!-- Like area -->
                    <td>
                        <a href="#" class="like-button" data-idea-id="{{ $idea->id }}">
                            <img src="/css/images/heart.png" width="20" height="20" alt="Like">
                            <i class="fa fa-heart"></i>
                        </a>
                        <span id="likeCount_{{ $idea->id }}">{{ $idea->favorites }}</span> <!-- Like count area -->
                    </td>
                    <td><a href="{{ route("idea.show", $idea->id) }}">Detail</a></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

@endsection
