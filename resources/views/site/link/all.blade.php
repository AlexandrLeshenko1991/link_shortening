@extends('layouts.main')

@section('content')
<div class="container ">
    @if(Session::has('add_new_link_success'))
    <div class="alert alert-success my-3 col-12" role="alert">
        {{ Session::pull('add_new_link_success', 'default') }}
    </div>
    @endif


    <table class="table my-3">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">create date</th>
            <th scope="col">original link</th>
            <th scope="col">more info</th>
        </tr>
        </thead>
        <tbody>
        @foreach($all_user_link as $one)
            <tr>
                <th scope="row">{{ $one->id }}</th>
                <td>{{ $one->created_at }}</td>
                <td>{{ $one->original }}</td>
                <td> <a href="{{route('link', [$one->id])}}" type="button" class="btn btn-success">more...</a></td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endsection
