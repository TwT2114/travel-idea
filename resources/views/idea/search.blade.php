@extends('layouts.app')

@section('content')

    <h1>Search Results</h1>
    @if(session()->has('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <h2>Total Counts: {{ $ideas->count() }}</h2>
    @if($ideas->count() > 0)
        <table class="result">
            <thead>
            <tr>
                <td class="tabletab">Title</td>
                <td class="tabletab">Destination</td>
                <td class="tabletab">Tags</td>
                <td class="tabletab">Start Date</td>
                <td class="tabletab">End Date</td>

            </tr>
            </thead>
            <tbody>
            @foreach($ideas as $idea)
                <tr>
                    <td>{{$idea->title}}</a></td>
                    <td>{{$idea->destination}}</td>
                    <td>{{$idea->tags}}</td>
                    <td>{{$idea->start_date}}</td>
                    <td>{{$idea->end_date}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @else
        <p>No matching ideas.</p>
    @endif
@endsection

