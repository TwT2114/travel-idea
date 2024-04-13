@extends('layouts.app')

@section('script')

@endsection

@section('content')
    <div class="title">
        Add a New Plan
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
