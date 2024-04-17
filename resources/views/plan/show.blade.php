@extends('layouts.app')

@section('content')
    <link rel="stylesheet" type="text/css" href="/css/create.css" />
    <link rel="stylesheet" type="text/css" href="/css/zebra.css" />

    <div>
        <a href="{{ url()->previous() }}">Back</a>
    </div>

    <div>
        <h1>{{ $plan->title }}</h1>
        <div style="display: flex; align-items: center;">
            <p>
            Post By<a href="{{ route('user.show',$plan->user_id) }}" style="margin-left: 5px;">{{ $plan->user_name }}</a>
            @if($plan->user_id == \Illuminate\Support\Facades\Auth::id()) <a href="{{ route('plan.edit', $plan->id) }}" style="margin-left: 10px;">Edit</a>
            @endif
            </p>
        </div>
    </div>

    <div>
        <div class="large-font">Added Ideas</div>
        @if($planIdeas->isNotEmpty())
            <table class="table table-hover zebra border-header">
                <thead class="plan-header">
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
