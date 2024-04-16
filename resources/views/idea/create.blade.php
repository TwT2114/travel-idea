@extends('layouts.app')

@section('script')
    <script src="{{ asset('js/datepicker.js') }}"></script>
    <script async
            src="https://maps.googleapis.com/maps/api/js?key={{config('api.google_map')}}&libraries=places&callback=initMap">
    </script>
    <link rel="stylesheet" type="text/css" href="/css/create.css" />
@endsection

@section('content')
    <a href="{{ url()->previous() }}">Back</a>
    <div class="title">
        Add a New Idea
    </div>
    <div class="main_table">
    <form method="post" action="{{ route('idea.store') }}">
        {{ csrf_field() }}
        <table class="table table-striped">
            <tbody>
            <tr>
                <td><label for="title">Title</label></td>
                <td><input name="title" type="text" class="form-control"/></td>
            </tr>
            <tr>
                <td><label for="destination">Destination</label></td>
                <td><input name="destination" type="text" class="form-control"/></td>
            </tr>
            <tr>
                <td><label for="datepicker">Start Date</label></td>
                <td><input name="start_date" type="text" class="form-control"
                           id="start_datepicker"></td>
            </tr>
            <tr>
                <td><label for="datepicker">End Date</label></td>
                <td><input name="end_date" type="text" class="form-control"
                           id="end_datepicker"></td>
            </tr>

            <tr>
                <td><label for="tags">Tags</label></td>
                <td><input name="tags" type="text" class="form-control"/></td>
            </tr>

            <tr>
                <td></td>
                <td>
                    <button type="submit" class="common-button idea-button">Add</button>
                </td>
            </tr>
            </tbody>
        </table>
    </form>
    </div>
@endsection
