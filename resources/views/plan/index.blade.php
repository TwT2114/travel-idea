@extends('layouts.app')

@section('content')
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
    <div>
        <table class="table">
            <thead>

            <th>User</th>
            <th>Title</th>

            <th></th>

            </thead>
            <tbody>
            @foreach($plans as $key => $plan)
                <tr>
                    <td><a href="{{route('user.show',$plan->user_id)}}"> {{$plan->user_name}}</a></td>
                    <td>{{$plan->title}}</td>
                    <td><a href="{{ route("plan.show", $plan->id) }}">Detail</a></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

@endsection
