@extends('layouts.app')
@section('title','-New Idea')
@section('script')
    <script src="{{ asset('js/datepicker.js') }}"></script>
    <link rel="stylesheet" type="text/css" href="/css/create.css">
@endsection

@section('content')
    <a href="{{ url()->previous() }}">Back</a>
    <div class="title">
        <article><h1>Add a New Idea</h1></article>
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
                    <td><label for="start_date">Start Date</label></td>
                    <td><input name="start_date" type="text" class="form-control"
                               id="start_date"></td>
                </tr>
                <tr>
                    <td><label for="end_date">End Date</label></td>
                    <td><input name="end_date" type="text" class="form-control"
                               id="end_date"></td>
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
