@extends('layouts.app')


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
        <h2>Comments</h2>
        <form id="comment-form" action="{{ route('comment.store') }}" method="POST">
            @csrf
            <input type="hidden" name="idea_id" value="{{ $idea->id }}">
            <textarea name="content" rows="3" cols="50"></textarea>
            <button type="submit">Submit</button>
        </form>

        <ul id="comment-list">
            @foreach ($idea->comments as $comment)
                <li>{{ $comment->content }}</li>
            @endforeach
        </ul>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script>
            $(document).ready(function() {
                $('#comment-form').submit(function(e) {
                    e.preventDefault();

                    var formData = $(this).serialize();

                    $.ajax({
                        url: $(this).attr('action'),
                        type: 'POST',
                        data: formData,
                        success: function(response) {
                            $('#comment-form textarea[name="content"]').val('');

                            var newComment = '<li>' + response.content + '</li>';
                            $('#comment-list').append(newComment);
                        }
                    });
                });
            });
        </script>
@endsection
