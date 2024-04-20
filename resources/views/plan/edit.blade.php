@extends('layouts.app')
@section('title', '-Edit Plan')
@section('script')
    <link rel="stylesheet" type="text/css" href="/css/create.css">
    <link rel="stylesheet" type="text/css" href="/css/zebra.css">
    <script>
        $(function () {
            $("#idea-list").tablesorter();
        });
    </script>
@endsection

@section('content')
    <a href="{{ url()->previous() }}">Back</a>
    <a href="{{ route('plan.show', $plan->id) }}">Detail</a>
    @if( $plan->user_id == \Illuminate\Support\Facades\Auth::id() )
        <div class="plan_body">
            <div style="display: flex; justify-content: space-between;">
                <article><h1>Edit Plan</h1></article>
                <div>
                    <form method="post" action="{{ route('plan.destroy', $plan->id) }}">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="common-button">Delete the Plan</button>
                    </form>
                </div>
            </div>
            <div>
                <div>
                    <form method="post" action="{{ route('plan.update', $plan->id) }}">
                        @method('PATCH')
                        @csrf
                        <table>
                            <tbody style="display: flex; justify-content: space-between;">
                            <tr>
                                <td class="large-font"><label for="title">Title</label></td>
                                <td style="margin-left: auto;">
                                    <input id="title" name="title" type="text" value="{{ $plan->title }}"
                                           class="form-control">
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    <button type="submit" class="common-button">Update</button>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <br>
                    </form>
                </div>
                <div>
                    @if($planIdeas->isNotEmpty())
                        <div>
                            <form method="post" action="{{ route('plan.removeAllIdeas', $plan->id ) }}">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="common-button">Remove All</button>
                            </form>
                        </div>
                        <table class="table table-hover zebra border-header">
                            <thead class="plan-header">
                            <tr>
                                <th>User</th>
                                <th>Title</th>
                                <th>Destination</th>
                                <th>Tags</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Operation</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($planIdeas as $key => $planIdea)
                                <tr>
                                    <td>
                                        <a href="{{ route('user.show',$planIdea->user_id) }}">
                                            {{ $planIdea->user_name }}
                                        </a>
                                    </td>
                                    <td>{{ $planIdea->title }}</td>
                                    <td>{{ $planIdea->destination }}</td>
                                    <td>{{ $planIdea->tags }}</td>
                                    <td>{{ $planIdea->start_date }}</td>
                                    <td>{{ $planIdea->end_date }}</td>
                                    <td>
                                        <form method="post"
                                              action="{{ route('plan.removeIdea', ['planId' => $plan->id, 'ideaId' => $planIdea->id]) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="common-button">Remove</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @else
                        <p>No ideas added</p>
                    @endif
                </div>
            </div>
        </div>
        <div class="plan_body">
            @if($ideas->isNotEmpty())
                <h2>Ideas to add</h2>
                <table id="idea-list" class="table table-hover zebra border-header">
                    <thead class="plan-header">
                    <tr>
                        <th>User</th>
                        <th>Title</th>
                        <th>Destination</th>
                        <th>Tags</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Add</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($ideas as $key => $idea)
                        <tr>
                            <td><a href="{{route('user.show',$idea->user_id)}}"> {{$idea->user_name}}</a></td>
                            <td>{{ $idea->title }}</td>
                            <td>{{ $idea->destination }}</td>
                            <td>{{ $idea->tags }}</td>
                            <td>{{ $idea->start_date }}</td>
                            <td>{{ $idea->end_date }}</td>
                            <td>
                                <form method="post" action="{{route('plan.addIdea')}}">
                                    {{ csrf_field() }}
                                    @csrf
                                    <input hidden="hidden" type="text" name="plan_id" value="{{ $plan->id}}">
                                    <input hidden="hidden" type="text" name="idea_id" value="{{ $idea->id }}">
                                    <button type="submit" class="common-button">Add</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @else
                <p>No ideas</p>
            @endif
        </div>
    @else
        <h1>You are not allowed to edit the plan.</h1>
    @endif
@endsection
