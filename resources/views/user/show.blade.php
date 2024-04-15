@extends('layouts.app')

@section('script')

@endsection

@section('content')
    <div>
        <a href="{{route('idea.index')}}">View Ideas</a>
        <a href="{{route('plan.index')}}">View Plans</a>
    </div>
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
    <h1>{{$user->name}}'s Created Ideas and Plans</h1>

    <h2>Created Ideas:</h2>
    <ul>
        @foreach($userIdeas as $idea)
            <li>
                <a href="{{route('idea.show', $idea->id)}}">{{$idea->title}}</a>
            </li>
        @endforeach
    </ul>

    <h2>Created Plans:</h2>
    <ul>
        @foreach($userPlans as $plan)
            <li>
                <a href="{{route('plan.show', $plan->id)}}">{{$plan->title}}</a>
            </li>
        @endforeach
    </ul>

@endsection
