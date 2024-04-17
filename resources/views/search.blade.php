@extends('layouts.app')

@section('script')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('js/favorites.js') }}"></script>
    <link rel="stylesheet" type="text/css" href="/css/zebra.css"/>
@endsection

@section('content')

    @if(session()->has('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <a href="{{ url()->previous() }}">Back</a>
    <div class="search-outcome">{{ $ideas->count() }} Ideas Found:</div>
    @if($ideas->count() > 0)
        <div>
            <table class="table table-hover zebra border-header">
                <thead class="plan-header">
                <tr>
                    <th>User</th>
                    <th>Title</th>
                    <th>Destination</th>
                    <th>Tags</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th></th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($ideas as $key => $idea)
                    <tr>
                        <td><a href="{{route('user.show',$idea->user_id)}}"> {{$idea->user_name}}</a></td>
                        <td>{{$idea->title}}</td>
                        <td>{{$idea->destination}}</td>
                        <td>{{$idea->tags}}</td>
                        <td>{{$idea->start_date}}</td>
                        <td>{{$idea->end_date}}</td>
                        <!-- 点赞的区域 -->
                        <td>
                            <a href="#" class="like-button" data-idea-id="{{ $idea->id }}">
                                <img src="/css/images/heart.png" width="20" height="20" alt="Like"/>
                                <i class="fa fa-heart"></i>
                            </a>
                            <span id="likeCount_{{ $idea->id }}">{{ $idea->favorites }}</span> <!-- 显示点赞数的区域 -->
                        </td>
                        <td><a href="{{ route("idea.show", $idea->id) }}">Detail</a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    @else
        <p>No matching ideas.</p>
    @endif

    @if($plans->count() > 0)
        <div class="search-outcome">{{ $plans->count() }} Plans Found:</div>
        <div>
            <table class="table table-hover zebra border-header">
                <thead class="plan-header">
                <tr>
                    <th>User</th>
                    <th>Title</th>
                    <th>Time</th>
                    <th>Detail</th>
                </tr>
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
    @else
        No matching plans.
    @endif

@endsection
