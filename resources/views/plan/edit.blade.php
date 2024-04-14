@extends('layouts.app')

@section('content')
    <a href="{{ route('plan.show', $plan->id) }}">Back</a>
    @if( $plan->user_id == \Illuminate\Support\Facades\Auth::id() )
        <div>
            <form method="post" action="{{ route('plan.destroy', $plan->id) }}">
                @method('DELETE')
                @csrf
                <button type="submit">Delete</button>
            </form>
        </div>
        <div>
            <h1>Edit Plan</h1>
        </div>
        <div>
            <h2>Plan Details</h2>
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
                    <table>
                        <thead>
                        <tr>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td><label for="title">Title</label></td>
                            <td><input id="title" name="title" type="text" value="{{ $plan->title }}"
                                       class="form-control">
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
                    <table>

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
                                          action="{{route('plan_idea.destroy', $planIdea->id)}}">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit">Remove</button>

                                    </form>
                                    {{--<a href="{{route('plan.removeIdea',[$plan->id, $planIdea->id])}}">Remove</a>--}}
                                </td>
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

                                <td>
                                    <form method="post" action="{{route('plan.addIdea')}}">
                                        {{ csrf_field() }}
                                        @csrf

                                        <input hidden="hidden" type="text" name="plan_id" value="{{ $plan->id}}">
                                        <input hidden="hidden" type="text" name="idea_id" value="{{ $idea->id }}">

                                        <button type="submit">Add</button>

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

        </div>
    @else

    @endif

@endsection
