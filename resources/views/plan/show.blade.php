@extends('layouts.app')

@section('script')

@endsection


@section('content')

    <div class="container">

        <h1>{{ $plan->title }}</h1>

        <p>{{ $plan->user_name }}</p>

    </div>

    <div>
        @foreach($planIdeas as $idea)


        @endforeach
    </div>
@endsection
