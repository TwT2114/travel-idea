@extends('layouts.app')

@section('script')
    <script>
        // 使用 jQuery 发起 AJAX 请求，提交评论并获取最新评论列表
        function submitComment() {
            var formData = $('#commentForm').serializeArray();
            $.post($('#commentForm').attr('action'), formData, function (response) {
                // 清空评论框
                $('#content').val('');
                updateComments();
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
        setInterval(updateComments, 5000); //  5 秒，根据需要调整时间间隔
    </script>
@endsection

@section('content')
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    <div>
        <a href="{{route('idea.index')}}">Back</a>

        {{--only the idea poster can modify--}}
        @if($idea->user_id == \Illuminate\Support\Facades\Auth::id())
            <a href="{{route("idea.edit", $idea->id)}}">Edit</a>
        @endif
    </div>
    {{--    <div id="map" style="width: 80%; height: 400px;"></div>--}}
    <div style="margin: auto; width: auto">
        <div>
            <h1>
                {{$idea->title}}
            </h1>

            <div id="weatherInfo" class="weather">
                <iframe title="weather" height="700" src="/idea/{{ $idea->id }}/weather"></iframe>
            </div>
            <div>
                Post By <a href="{{route('user.show',$idea->user_id)}}">{{$idea->user_name}}</a>
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


        {{--Google Map--}}
        <div>
            <iframe class="map"
                    title="map"
                    width="50%"
                    height="450"
                    loading="lazy"
                    allowfullscreen
                    referrerpolicy="no-referrer-when-downgrade"
                    src="https://www.google.com/maps/embed/v1/place?key={{config('api.google_map')}}&q={{$idea->destination}}">
            </iframe>
        </div>
        <div>
            <p>Latitude：{{$idea->latitude}}</p>
            <p>Longitude：{{$idea->longitude}}</p>
        </div>

        <!-- 热门景点api -->
        @if($idea)
            <a href="{{ route('idea.getPointsOfInterest', $idea->id) }}">Get Points Of Interest (Support cities in
                EU)</a>
        @else
            <p>no points of interest</p>
        @endif



        <!-- 用户提交评论模块 -->
        <form method="post" action="{{ route('comment.store') }}" id="commentForm">
            @csrf
            {{ csrf_field() }}
            <div class="form-group">
                <label for="content">My Comment</label>
                <input hidden="hidden" id="idea_id" name="idea_id" type="text" value="{{ $idea->id }}">
                <input id="content" name="content" type="text">
                <button type="submit" class="btn btn-primary">submit</button>
            </div>
        </form>
        <!-- 评论区，只展示最新的10条评论 -->
        <div class="comments-section">
            <h3>Comments</h3>
            <ul id="commentList">
                @foreach ($idea->comments->reverse() as $comment)
                    <li>
                        <strong>{{ $comment->user_name }}</strong>
                        <p>{{ $comment->content }}</p>
                        <time datetime="{{ $comment->created_at }}">{{ $comment->created_at }}</time>
                        <form method="get" action="{{ route('comment.delete', $comment->id) }}">
                            {{--                            @method('DELETE')--}}
                            {{--                            <input hidden="hidden" type="text" name="comment_id" value="{{ $comment->id }}">--}}
                            <button type="submit">Delete</button>
                        </form>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
@endsection
