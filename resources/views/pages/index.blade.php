@extends('layouts/app')


@section('content')

    <div class="row mx-auto">

        <div class="jumbotron-fluid col-5 align-content-center mx-auto">
            <h1>Laravel From Scratch</h1> <br>
            <p>{{$variable}}</p>
            <a href="/register" class="btn btn-info">Register</a>
            <a href="/login" class="btn btn-secondary">Login</a>
        </div>

    </div>



@endsection
