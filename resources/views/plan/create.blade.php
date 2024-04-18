@extends('layouts.app')
@section('title', '-New Plan')
@section('script')
    <link rel="stylesheet" type="text/css" href="/css/create.css"/>
@endsection

@section('content')
    <a href="{{ url()->previous() }}">Back</a>
    <div class="title">
        <article><h1>Add a New Plan</h1></article>
    </div>
    <form method="post" action="{{ route('plan.store') }}">
        {{ csrf_field() }}
        <table class="table table-striped">
            <tbody>
            <tr>
                <td><label for="title">Name Your Plan</label></td>
                <td><input name="title" type="text" class="form-control"/></td>
            </tr>

            <tr>
                <td></td>
                <td>
                    <button type="submit" class="plan-button common-button">Add</button>
                </td>
            </tr>
            </tbody>
        </table>
    </form>
@endsection
