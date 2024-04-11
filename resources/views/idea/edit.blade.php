@extends('layouts.app')

@section('content')
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
            <form method="post" action="{{ route('idea.update', $idea->id) }}">
                @method('PATCH')
                @csrf
                <table class="table table-striped">
                    <caption>Edit Idea</caption>
                    <tbody>
                    <tr>
                        <td><label for="title">Title</label></td>
                        <td><input id="title" name="title" type="text" value="{{ $idea->title }}" class="form-control">
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
                            <button type="submit">Update</button>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </form>
        </div>
    </div>
@endsection
