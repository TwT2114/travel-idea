@extends('layouts.app')

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
                    <td><a href="{{ route("idea.show", $idea->id) }}">Detail</a></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

@endsection
