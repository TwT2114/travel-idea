@extends('layouts.app')

@section('script')
@endsection

@section('content')
    <link rel="stylesheet" type="text/css" href="/css/user.css" />

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
    <h2>{{$user->name}}'s Created Ideas and Plans</h2>

    <div class="user-container">
        <div class="user-section">
            <h3>Created Ideas:</h3>
            <ul>
                @foreach($userIdeas as $idea)
                    <li>
                        <a href="{{route('idea.show', $idea->id)}}">{{$idea->title}}</a>
                    </li>
                @endforeach
            </ul>
        </div>

        <div class="user-section">
            <h3>Created Plans:</h3>
            <ul>
                @foreach($userPlans as $plan)
                    <li>
                        <a href="{{route('plan.show', $plan->id)}}">{{$plan->title}}</a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>

    <div>
        <a href="{{route('idea.index')}}">View All Ideas</a>
        <a href="{{route('plan.index')}}">View All Plans</a>
    </div>
@endsection
