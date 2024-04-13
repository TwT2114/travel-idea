@extends('layouts.app')

@section('script')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            function fetchComments() {
                $.get("/api/comments", function (response) {
                    $("#comments").empty();

                    response.forEach(function (comment) {
                        var commentItem = $("<li>").text(comment.user_name + ": " + comment.content);
                        $("#comments").append(commentItem); // Use append instead of prepend
                    });
                });
            }

            fetchComments();
            setInterval(fetchComments, 5000);

            $("#comment-form").submit(function (e) {
                e.preventDefault();

                var userId = $("#user-id").val();
                var ideaId = "{{ $idea->id }}";
                var comment = $("#comment-input").val();

                $.post("/api/comments", {
                    user_id: userId,
                    idea_id: ideaId,
                    content: comment
                }, function (response) {
                    $("#comment-input").val("");
                    fetchComments();
                });
            });
        });
    </script>
@endsection

@section('content')

    {{--    <div id="map" style="width: 80%; height: 400px;"></div>--}}
    <div style="margin: auto; width: auto">
        <div>
            <h1>
                {{$idea->title}}
            </h1>
            <div>
                Post By <a href="{{route('user.show',$idea->user_id)}}">{{$idea->user_name}}</a>
            </div>

            <div>
                {{$idea->destination}}
            </div>
            <div>
                Start Date: {{$idea->start_date}}
            </div>
            <div>
                End Date: {{$idea->end_date}}
            </div>
            <div>
                Tags: {{$idea->tags}}
            </div>

            {{--only the idea poster can modify--}}
            @if($idea->user_id == \Illuminate\Support\Facades\Auth::id())
                <div>
                    <a href="{{route("idea.edit", $idea->id)}}">Edit</a>
                </div>
            @endif

        </div>

        <div>
            <iframe
                title="map"
                width="80%"
                height="450"
                style="border:0"
                loading="lazy"
                allowfullscreen
                referrerpolicy="no-referrer-when-downgrade"
                src="https://www.google.com/maps/embed/v1/place?key={{config('api.google_map')}}
                &q={{$idea->destination}}">
            </iframe>
        </div>
        <!-- 用户提交评论模块 -->
        @auth
            <form method="post" action="{{ route('comment.store') }}">
                @csrf
                <div class="form-group">
                    <label for="content">My Comment</label>
                    <textarea class="form-control" id="content" name="content"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">submit</button>
            </form>
        @else
            <p>please login!</p>
        @endauth
        <!-- 评论区 -->
        <div class="comments-section">
            <h3>Comments</h3>
            <ul id="commentList">
                @foreach ($idea->comments as $comment)
                    <li>
                        <strong>{{ $comment->user_name }}</strong>
                        <p>{{ $comment->content }}</p>
                        <p>{{ $comment->created_at }}</p>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>

    <script>
        // 使用 jQuery 发起 AJAX 请求，提交评论并获取最新评论列表
        $('#commentForm').submit(function(e) {
            e.preventDefault();
            var formData = $(this).serializeArray();
            $.post($(this).attr('action'), formData, function(response) {
                // 更新评论列表
                var commentList = $('#commentList');
                var newComment = '<li><strong>' + response.user_name + '</strong><p>' + response.content + '</p><p>' + response.created_at + '</p></li>';
                commentList.prepend(newComment);
                // 清空评论框
                $('#content').val('');
            }, 'json');
        });
    </script>
@endsection
