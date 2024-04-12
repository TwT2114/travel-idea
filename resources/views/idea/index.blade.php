@extends('layouts.app')

@section('content')
    <div class="search-box">
        <form action="{{ route('idea.search') }}" method="GET">
            <input type="text" name="searchTerm" placeholder="Search for travel ideas...">
            <button type="submit">Search</button>
        </form>
    </div>
    <div>
        <table>
            <thead>

            <th>User</th>
            <th>Title</th>
            <th>Destination</th>
            <th>Tags</th>
            <th>Start Date</th>
            <th>End Date</th>
            <th></th>

            </thead>
            <tbody>
            @foreach($ideas as $key => $idea)
                <tr>
                    <td><a href="{{route('user.show',$idea->user_id)}}"> {{$idea->user_name}}</a></td>
                    <td>{{$idea->title}}</td>
                    <td>{{$idea->destination}}</td>
                    <td>{{$idea->tags}}</td>
                    <td>{{$idea->start_date}}</td>
                    <td>{{$idea->end_date}}</td>


                    <td><a href="{{ route("idea.show", $idea->id) }}">Detail</a></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
