@extends('layouts.app')

@section('content')
    <div>
        <table class="table">
            <thead>
            <th>User</th>
            <th>Title</th>
            <th>Time</th>
            <th>Detail</th>
            </thead>
            <tbody>
            @foreach($plans as $key => $plan)
                <tr>
                    <td><a href="{{route('user.show',$plan->user_id)}}"> {{$plan->user_name}}</a></td>
                    <td>{{$plan->title}}</td>
                    <td>{{$plan->created_at}}</td>
                    <td><a href="{{ route("plan.show", $plan->id) }}">Detail</a></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

@endsection
