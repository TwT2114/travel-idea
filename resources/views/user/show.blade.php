@extends('layouts.app')

@section('script')
    <link rel="stylesheet" type="text/css" href="/css/user.css"/>
    <script src="{{ asset('js/buttonShow.js') }}"></script>
@endsection

@section('content')
    <a href="{{ url()->previous() }}" class="left">Back</a>
    <div class="homeHead-item">
        <ul>
            <li>
                <img src="/css/images/User_homepage.png" alt="User">
                <div class="homeHead-text">{{$user->name}}'s homepage</div>
            </li>
        </ul>
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

    <div class="user-container">
        <div class="user-section">
            <div class="sub-head">Created Ideas:</div>
            <div class="mainBody">
                @foreach($userIdeas as $idea)
                    <div>
                        <a href="{{route('idea.show', $idea->id)}}">{{$idea->title}}</a>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="user-section">
            <div class="sub-head">Created Plans:</div>
            <div class="mainBody">
                @foreach($userPlans as $plan)
                    <div>
                        <a href="{{route('plan.show', $plan->id)}}">{{$plan->title}}</a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="more-info">
        <div>Want some ideas for your trip?</div>
        <button onclick="toggleIdeas()">▼</button>
    </div>
    <div id="ideaSection" style="display: none; text-align: left;">
        <a href="{{route('idea.index')}}">All Ideas&nbsp;&nbsp;</a>
        <a href="{{route('plan.index')}}">&nbsp;&nbsp;All Plans</a>
    </div>

@endsection
