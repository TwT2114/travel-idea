@extends('layouts.app')

@section('content')
    <link rel="stylesheet" type="text/css" href="/css/create.css"/>
    <a href="{{ url()->previous() }}">Back</a>
    @if($idea->user_id==\Illuminate\Support\Facades\Auth::id())
        <div>
            <form method="post" action="{{ route('idea.destroy', $idea->id) }}">
                @csrf
                @method('DELETE')
                <button type="submit" class="common-button">Delete</button>
            </form>
        </div>
        <br>
        <div>
            <div class="title">Edit Idea</div>
        </div>
        <div>
            <div class="main_table">
                <form method="post" action="{{ route('idea.update', $idea->id) }}">
                    @method('PATCH')
                    @csrf
                    <table class="table table-striped">
                        <tbody>
                        <tr>
                            <td><label for="title">Title</label></td>
                            <td><input id="title" name="title" type="text" value="{{ $idea->title }}"
                                       class="form-control">
                            </td>
                        </tr>
                        <tr>
                            <td><label for="destination">Destination</label></td>
                            <td><input id="destination" name="destination" type="text" value="{{ $idea->destination }}"
                                       class="form-control">
                            </td>
                        </tr>
                        <tr>
                            <td><label for="start_date">Start Date</label></td>
                            <td><input id="start_date" name="start_date" type="text" value="{{ $idea->start_date }}"
                                       class="form-control">
                            </td>
                        </tr>
                        <tr>
                            <td><label for="end_date">End Date</label></td>
                            <td><input id="end_date" name="end_date" type="text" value="{{ $idea->end_date }}"
                                       class="form-control">
                            </td>
                        </tr>
                        <tr>
                            <td><label for="tags">Tags</label></td>
                            <td><input id="tags" name="tags" type="text" value="{{ $idea->tags }}" class="form-control">
                            </td>
                        </tr>

                        <tr>
                            <td></td>
                            <td>
                                <button type="submit" class="common-button edit-button">Update</button>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </form>
            </div>
        </div>
    @else
        <h1>You are not allowed to edit this idea</h1>
    @endif

@endsection
