@extends('layout')

@section('head')
<title>Search Results</title>
@endsection

@section('content')
<h1>Search Results</h1>
<div>
    @if(session()->get('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div><br/>
    @endif

    <h2>counts: {{ $results->count() }}</h2>
        <table class="result_table">
            <thead>
            <tr>
                <td class="tabletab">Title</td>
                <td class="tabletab">Destination</td>
                <td class="tabletab">Start Date</td>
                <td class="tabletab">End Date</td>

            </tr>
            </thead>
            <tbody>
            @foreach($results as $result)
                <tr>
                    <td>{{$result->title}}</a></td>
                    <td>{{$result->destination}}</td>
                    <td>{{$result->start_date}}</td>
                    <td>{{$result->end_date}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
</div>

