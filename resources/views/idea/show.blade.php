@extends('layouts.app')


@section('script')
    {{--    <script async--}}
    {{--            src="https://maps.googleapis.com/maps/api/js?key={{config('api.google_map')}}&libraries=places&callback=initMap">--}}
    {{--    </script>--}}
    {{--    <script type="module" src="/js/map.js"></script>--}}

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
        <div>
            <h2>Add your comment</h2>
            <form id="commentForm">
                @csrf
                <div>
                    <textarea id="commentInput" name="comment" rows="3" cols="50"></textarea>
                </div>
                <button type="submit">Add Comment</button>
            </form>
        </div>

        <div>
            <h2>Comments</h2>
            <ul id="commentList">
                @if($idea->comments)
                    @foreach($idea->comments as $comment)
                        <li>{{$comment->comment}}</li>
                    @endforeach
                @endif
            </ul>
        </div>

        <script>
            $(document).ready(function () {
                $('#commentForm').submit(function (event) {
                    event.preventDefault();

                    var comment = $('#commentInput').val();

                    $.ajax({
                        type: 'POST',
                        url: "{{ route('comment.store', ['id' => $idea->id]) }}",
                        data: { comment: comment, _token: '{{ csrf_token() }}' },
                        success: function (data) {
                            $('#commentList').append('<li>' + comment + '</li>');
                            $('#commentInput').val('');  // 清空评论输入框
                        }
                    });
                });
            });
        </script>
@endsection
