@extends('layouts/app')


@section('content')

    <div>
        <h1>Laravel From Scratch services</h1>
    </div>

    @if($services)
        <ul class="list-group">
            @foreach($services as $service)
                <li class="list-group-item my-1">{{$service}}</li>

            @endforeach

        </ul>

    @endif

@endsection
