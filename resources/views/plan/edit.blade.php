@extends('layouts.app')

@section('content')
    <div>
        <a href="{{ route('plan.index') }}">Back</a>

        <a href="{{ route('plan.show', $plan->id) }}">Show</a>

        <a href="{{ route('plan.destroy', $plan->id) }}">Delete</a>

        <a href="{{ route('plan.create') }}">Create</a>
    </div>
    <div>
        <div class="message">
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
            <form method="post" action="{{ route('plan.update', $plan->id) }}">
                @method('PATCH')
                @csrf
                <table class="table table-striped">
                    <caption>Edit Plan</caption>
                    <thead>
                    <tr>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td><label for="title">Title</label></td>
                        <td><input id="title" name="title" type="text" value="{{ $plan->title }}" class="form-control">
                        </td>
                    </tr>


                    <tr>
                        <td></td>
                        <td>
                            <button type="submit">Update</button>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </form>
        </div>
        <div>
            <h2>Added Ideas</h2><br>
            @if($planIdeas->isNotEmpty())
                {{--<a href="{{route('plan.removeAllIdeas',$plan->id)}}">Remove All</a>--}}

                <table>
                    <caption>Added Ideas</caption>
                    <thead>
                    <tr>
                        <th>User</th>
                        <th>Title</th>
                        <th>Destination</th>
                        <th>Tags</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Remove</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($planIdeas as $key => $planIdea)
                        <tr>
                            <td>{{ $planIdea->idea->title }}</td>
                            <td><a href="{{route('user.show',$planIdea->user_id)}}"> {{$planIdea->user_name}}</a></td>
                            <td>{{ $planIdea->title }}</td>
                            <td>{{ $planIdea->destination }}</td>
                            <td>{{ $planIdea->tags }}</td>
                            <td>{{ $planIdea->start_date }}</td>
                            <td>{{ $planIdea->end_date }}</td>
                            <td><a href="{{route('plan.removeIdea',[$plan->id, $planIdea->id])}}">Remove</a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @else
                <p>No ideas added</p>
            @endif
        </div>
        <div>
            @if($ideas->isNotEmpty())
                <h2>Ideas to add</h2>
                <table>
                    <caption>Ideas</caption>
                    <thead>
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

                            <td><a href="{{route('plan.addIdea',[$plan->id, $idea->id])}}">Add</a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @else
                <p>No ideas</p>
            @endif

        </div>

    </div>
@endsection
