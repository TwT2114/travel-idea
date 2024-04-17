@extends('layouts.app')

@section('script')

@endsection

@section('content')
    <article>
        <div><h1>Welcome to Travel Idea, {{ \Illuminate\Support\Facades\Auth::user()->name }}</h1></div>
    </article>
@endsection

