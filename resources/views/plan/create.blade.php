@extends('layouts.app')

@section('script')

@endsection

@section('content')
    <div class="title">
        Add a New Plan
    </div>


    <form method="post" action="{{ route('plan.store') }}">
        {{ csrf_field() }}
        <table class="table table-striped">
            <tbody>
            <tr>
                <td><label for="title">Title</label></td>
                <td><input name="title" type="text" class="form-control"/></td>
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
