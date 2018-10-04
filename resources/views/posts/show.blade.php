@extends('layouts/app')


@section('content')

    <div class="my-2">
        <h1>Post {{$post->title}}</h1>

        <small>{{$post->created_at}}</small>

        <p class="lead">{{$post->content}}</p>

    </div>

    <a href="/posts/{{$post->id}}/edit" class="btn btn-info my-3">Edit</a>

    {!! Form::open(['action'=>['PostsController@destroy', $post->id], 'method'=>'POST']) !!}

        {{Form::hidden('_method', 'DELETE')}}
        {{Form::submit('Delete', ['class'=>'btn btn-danger'])}}

    {!! Form::close() !!}




@endsection
