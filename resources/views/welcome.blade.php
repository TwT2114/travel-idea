@extends('layouts.app')

@section('script')

@endsection

@section('content')
    <article>
        <div><h1>Welcome to Travel Idea, {{ \Illuminate\Support\Facades\Auth::user()->name }}</h1></div>
        <div>
            <p>
                You can post your travel ideas,
                chat with friends under the idea,
                and create travel plans with ideas.
            </p>
        </div>
    </article>
@endsection

