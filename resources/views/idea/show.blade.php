@extends('layouts.app')
@section('title', '-Idea Detail')

@section('script')
    <link rel="stylesheet" type="text/css" href="/css/info.css"/>
    <link rel="stylesheet" type="text/css" href="/css/create.css"/>
@endsection

@section('script')

    <script>
        // 使用 jQuery 发起 AJAX 请求，提交评论并获取最新评论列表
        function submitComment() {
            var formData = $('#commentForm').serializeArray();
            $.post($('#commentForm').attr('action'), formData, function (response) {
                // 清空评论框
                $('#content').val('');
            }, 'json');
        }

        // 获取最新评论列表并更新页面
        function updateComments() {
            $.get('{{ route('comment.index', ['idea_id' => $idea->id]) }}', function (response) {
                var commentList = $('#commentList');
                commentList.empty();

                response.forEach(function (comment) {
                    var newComment = '<li>' +
                        '<strong>' + comment.user_name + '</strong>' +
                        '<p>' + comment.content + '</p>' +
                        '<time>' + comment.created_at + '</time>' +
                        '<form method="get" action="/comment/delete/' + comment.id + '">' +
                        // '<input type="hidden" name="comment_id" value="'+ comment.id +'"> ' +
                        '<button type="submit">Delete</button>' +
                        '</form>' +
                        '</li>';
                    commentList.append(newComment);
                });
            });
        }

        // 每隔一定时间间隔调用 updateComments 函数
        setInterval(updateComments, 5000); //  5 秒
    </script>
@endsection

@section('content')
    {{--        左上--}}
<div class="idea-container">
    <div class="top-left">
    <div>
        <a href="{{route('idea.index')}}">Back</a>
    </div>

    <div>
        <div>
            <div class="idea-title">
                <article>
                    <h1>{{$idea->title}}</h1>
                </article>
            </div>

            <div>
                Post By <a href="{{route('user.show',$idea->user_id)}}">{{$idea->user_name}}</a>
                {{--only the idea poster can modify--}}
                @if($idea->user_id == \Illuminate\Support\Facades\Auth::id())
                    <a href="{{route("idea.edit", $idea->id)}}">&nbsp;&nbsp;&nbsp;Edit</a>
                @endif
            </div>

            <div>
                {{$idea->destination}}
            </div>
            <div>
                Start From {{$idea->start_date}} to {{$idea->end_date}}
            </div>
            <div>
                Tags: {{$idea->tags}}
            </div>
        </div>
    </div>
    </div>
        {{--        左下--}}
    <div class="bottom-left">
{{--        <div>--}}
            <div class="map-container">
                <iframe class="map"
                        title="map"
                        loading="lazy"
                        allowfullscreen
                        referrerpolicy="no-referrer-when-downgrade"
                        src="https://www.google.com/maps/embed/v1/place?key={{config('api.google_map')}}&q={{$idea->destination}}¢er={{$idea->latitude}},{{$idea->longitude}}">
                </iframe>
                <!-- 热门景点api -->
                @if($idea)
                    <div class="interest">
                        <a href="{{ route('idea.getPointsOfInterest', $idea->id) }}">▶Get Points of Interest (Support
                            cities in
                            EU)</a>
                        @else
                            <p>no points of interest</p>
                        @endif
                    </div>
            </div>
{{--        </div>--}}
    </div>
    {{--        右上--}}
    <div class="top-right">
        <div id="weatherInfo" class="weather">
            <iframe title="weather" src="/idea/{{ $idea->id }}/weather"></iframe>
        </div>
    </div>
    {{--        右下--}}
            <!-- 评论区 -->
    <div class="bottom-right">
            <div class="comments-section">
                <div class="common-header">Comments</div>
                <div class="commentList">
                    @if($idea->comments->isEmpty())
                        <p>Oops, there's no comment.</p>
                    @else
                        <div>
                            @foreach ($idea->comments->reverse() as $comment)
                                <div class="comment-info">
                                    <div>
                                        <strong>{{ $comment->user_name }}</strong>
                                        <form method="get" action="{{ route('comment.delete', $comment->id) }}">
                                            <button type="submit">Delete</button>
                                        </form>
                                    </div>
                                    <p>{{ $comment->content }}</p>
                                    <time datetime="{{ $comment->created_at }}">{{ $comment->created_at }}</time>
                                </div>
                            @endforeach
                        </div>
                </div>
                @endif
                <!-- 提交评论 -->
                <div class="form-group">
                <form method="post" action="{{ route('comment.store') }}">
                    @csrf
                        <label for="content">My Comment</label>
                        <input hidden="hidden" id="idea_id" name="idea_id" type="text" value="{{ $idea->id }}">
                        <input id="content" name="content" type="text">
                        <button type="submit" class="common-button">submit</button>
                </form>
                </div>
        </div>
    </div>
</div>
@endsection
