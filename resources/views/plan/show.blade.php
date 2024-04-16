@extends('layouts.app')

@section('script')

@endsection


@section('content')
    <div>
        <a href="{{ route('plan.index') }}">Back</a>

        <a href="{{ route('plan.create') }}">Create</a>

        {{--check User--}}
        @if($plan->user_id == \Illuminate\Support\Facades\Auth::id())
            <a href="{{ route('plan.edit', $plan->id) }}">Edit</a>
        @endif
    </div>

    <div>

        <h1>{{ $plan->title }}</h1>

        <p>Post By <a href="{{ route('user.show',$plan->user_id) }}"> {{ $plan->user_name }}</a></p>

    </div>

    <div>
        <h2>Added Ideas</h2><br>
        @if($planIdeas->isNotEmpty())
            <table>
                <thead>
                <tr>
                    <th>User</th>
                    <th>Title</th>
                    <th>Destination</th>
                    <th>Tags</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Detail</th>
                </tr>
                </thead>
                <tbody>
                @foreach($planIdeas as $planIdea)
                    <tr>
                        <td><a href="{{route('user.show',$planIdea->user_id)}}"> {{$planIdea->user_name}}</a></td>
                        <td>{{ $planIdea->title }}</td>
                        <td>{{ $planIdea->destination }}</td>
                        <td>{{ $planIdea->tags }}</td>
                        <td>{{ $planIdea->start_date }}</td>
                        <td>{{ $planIdea->end_date }}</td>
                        <td><a href="{{ route('idea.show', $planIdea->id) }}">Detail</a></td>

                    </tr>
                @endforeach
                </tbody>
            </table>
            @if($plan->loc != null)
                <iframe class="map"
                        title="map"
                        width="50%"
                        height="450"
                        loading="lazy"
                        allowfullscreen
                        referrerpolicy="no-referrer-when-downgrade"
                        src="https://www.google.com/maps/embed/v1/directions?key={{ config('api.google_map') }}&{!! $plan->loc !!}">
                    {{--src="https://www.google.com/maps/embed/v1/directions?key={{config('api.google_map')}}&origin=30.753924,120.758543&destination=31.2983399,120.58319&waypoints=31.230416,121.473701">--}}
                </iframe>
            @endif

        @else
            <p>No ideas added</p>
        @endif
    </div>
@endsection
