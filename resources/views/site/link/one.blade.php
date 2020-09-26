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
                <th scope="col">val</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <th scope="row">id</th>
                <td>{{$link->id}}</td>
            </tr>
            <tr>
                <th scope="row">Original link</th>
                <td>{{$link->original}}</td>
            </tr>
            <tr>
                <th scope="row">Generate link</th>
                <td><a href="{{route('custom.link',[$link->custom_code]) }}">{{route('custom.link',[$link->custom_code]) }}</a></td>
            </tr>
            <tr>
                <th scope="row">Clicks</th>
                <td>{{$link->clicks}}</td>
            </tr>
            <tr>
                <th scope="row">Last click</th>
                <td>{{$link->updated_at}}</td>
            </tr>
            <tr>
                <th scope="row">Statistics</th>
                <td><a class="btn btn-success" href="{{route('link.statistic',[$link->id])}}">view</a></td>
            </tr>
            </tbody>
        </table>
    </div>
@endsection
