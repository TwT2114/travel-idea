@extends('layouts.app')

@section('script')
    <link rel="stylesheet" type="text/css" href="/css/zebra.css"/>
@endsection

@section('content')
    <div>
        <table class="table table-hover zebra border-header">
            <thead class="plan-header">
            <th>User</th>
            <th>Title</th>
            <th>Time</th>
            <th>Detail</th>
            </thead>
            <tbody class="zebra"> <!-- 添加zebra类名到tbody -->
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
