@extends('layouts.app')

@section('content')
        <ul class="poi-list">
            @foreach($data as $poi)
            <li class="poi-item">
            <h3>{{ $poi['name'] }}</h3>
            <p>Category: {{ $poi['category'] }}</p>
            <p>Latitude: {{ $poi['geoCode']['latitude'] }}, Longitude: {{ $poi['geoCode']['longitude'] }}</p>
            <p>Rank: {{ $poi['rank'] }}</p>
            <p>Tags: {{ implode(', ', $poi['tags']) }}</p>
            </li>
            @endforeach
        </ul>
@endsection
