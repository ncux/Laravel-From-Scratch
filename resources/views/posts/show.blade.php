@extends('layouts/app')


@section('content')

    <div class="my-2">
        <h1>{{$post->title}}</h1>

         <small>Created on {{$post->created_at}} by {{$post->user->name}}</small>

        <p class="lead">{{$post->content}}</p>

    </div>

    @if(!Auth::guest())

        @if(Auth::user()->id == $post->user_id)
            <a href="/posts/{{$post->id}}/edit" class="btn btn-info my-3">Edit</a>

            {!! Form::open(['action'=>['PostsController@destroy', $post->id], 'method'=>'POST']) !!}

                {{Form::hidden('_method', 'DELETE')}}
                {{Form::submit('Delete', ['class'=>'btn btn-danger'])}}

            {!! Form::close() !!}
        @else

        @endif
    @else

    @endif






@endsection
