@extends('layouts.app')

@section('script')
    <script>
        $(function () {
            $("#start_datepicker").datepicker({dateFormat: 'yy-mm-dd'});
        });
        $(function () {
            $("#end_datepicker").datepicker({dateFormat: 'yy-mm-dd'});
        });
    </script>
    <script async
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDP0xl298_t8EaEby3eCerFXFBidi0tS-o&libraries=places&callback=initMap">
    </script>
    <script type="module" src="/js/map.js"></script>
@endsection

@section('content')

    <div class="title">
        Add a New Idea
    </div>
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
{{--        <div>--}}
{{--            <iframe--}}
{{--                width="600"--}}
{{--                height="450"--}}
{{--                style="border:0"--}}
{{--                loading="lazy"--}}
{{--                allowfullscreen--}}
{{--                referrerpolicy="no-referrer-when-downgrade"--}}
{{--                src="https://www.google.com/maps/embed/v1/place?key=AIzaSyDP0xl298_t8EaEby3eCerFXFBidi0tS-o--}}
{{--            &q=HK">--}}
{{--            </iframe>--}}
{{--        </div>--}}

    <form method="post" action="{{ route('idea.store') }}">
        {{ csrf_field() }}
        <table class="table table-striped"
               style="font-size: medium;text-align: center;vertical-align: center;width: 70%; margin: auto;">
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
                    <button type="submit">Add</button>
                </td>
            </tr>
            </tbody>
        </table>
    </form>
@endsection
