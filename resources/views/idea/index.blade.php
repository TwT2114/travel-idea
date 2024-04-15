@extends('layouts.app')

@section('script')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.like-button').click(function(e) {
                e.preventDefault();
                var ideaId = $(this).data('idea-id');
                var likeCountElement = $('#likeCount_' + ideaId);

                $.ajax({
                    url: '/idea/like/' + ideaId,
                    method: 'GET',
                    success: function(response) {
                        var data = response.data;
                        likeCountElement.text(data.favorites);
                    },
                    error: function(response) {
                        console.log(response);
                    }
                });
            });
        });
    </script>
@endsection

@section('content')
    <div class="message">
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
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
    <div>
        <table class="table">
            <thead>
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
                    <td><a href="{{route('user.show',$idea->user_id)}}"> {{$idea->user_name}}</a></td>
                    <td>{{ $idea->title }}</td>
                    <td>{{ $idea->destination }}</td>
                    <td>{{ $idea->tags }}</td>
                    <td>{{ $idea->start_date }}</td>
                    <td>{{ $idea->end_date }}</td>
                    <!-- 点赞的区域 -->
                    <td>
                        <a href="#" class="like-button" data-idea-id="{{ $idea->id }}">
                            <img src="/css/images/heart.png" width="20" height="20" alt="Like" />
                            <i class="fa fa-heart"></i>
                        </a>
                        <span id="likeCount_{{ $idea->id }}">{{ $idea->favorites }}</span> <!-- 显示点赞数的区域 -->
                    </td>
                    <td><a href="{{ route("idea.show", $idea->id) }}">Detail</a></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

@endsection
