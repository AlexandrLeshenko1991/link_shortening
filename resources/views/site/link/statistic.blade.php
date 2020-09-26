@extends('layouts.main')

@section('content')
    <div class="container ">
        <a class="btn btn-success my-2" href="{{route('link',[$link->id])}}">Back</a>
        <table class="table my-3">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">date</th>
                <th scope="col">ip</th>
                <th scope="col">region</th>
                <th scope="col">browser</th>
                <th scope="col">os</th>
            </tr>
            </thead>
            <tbody>
            @foreach($statistic as $one)
                <tr>
                    <th scope="row">{{ $one->id }}</th>
                    <td>{{ $one->created_at }}</td>
                    <td>{{ $one->ip }}</td>
                    <td>{{ $one->region }}</td>
                    <td>{{ $one->browser }}</td>
                    <td>{{ $one->os }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
