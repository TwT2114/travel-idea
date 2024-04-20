@extends('layouts.app')
@section('title', '-Welcome')
@section('script')

@endsection

@section('content')
    @guest()
        <div>
            <article>
                <h1>Welcome to {{ config('app.name', 'Travel Idea') }}, please

                    @if (Route::has('login'))
                        <p class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </p>
                    @endif
                    /
                    @if (Route::has('register'))
                        <p class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </p>
                    @endif
                </h1>
                <p>
                    You can post your travel ideas,
                    chat with friends under the idea,
                    and create travel plans with ideas after login.
                </p>
            </article>
        </div>
    @else
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
    @endguest
@endsection

