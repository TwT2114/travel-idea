@extends('layouts.app')

@section('script')

@section('content')
    <div>
        <a href="{{route('idea.index')}}">View Ideas</a>
        <a href="{{route('plan.index')}}">View Plans</a>
    </div>

    <h1>{{$user->name}}'s Created Ideas and Plans</h1>

    <h2>Created Ideas:</h2>
    <ul>
        @foreach($user->ideas as $idea)
            <li>
                <a href="{{route('idea.show', $idea->id)}}">{{$idea->title}}</a>
            </li>
        @endforeach
    </ul>

    <h2>Created Plans:</h2>
    <ul>
        @foreach($user->plans as $plan)
            <li>
                <a href="{{route('plan.show', $plan->id)}}">{{$plan->title}}</a>
            </li>
        @endforeach
    </ul>
    </div>
@endsection
