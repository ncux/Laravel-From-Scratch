@extends('layouts/app')


@section('content')

    <div class="my-2">
        <h2>Edit blog post</h2>

        {!! Form::open(['action'=>['PostsController@update', $post->id], 'method'=>'POST', 'enctype'=>'multipart/form-data']) !!}

            <div class="form-group">
                {{Form::label('title', 'Title')}}
                {{Form::text('title', $post->title, ['class'=>'form-control', 'required'])}}

            </div>
            <div class="form-group">
                {{Form::label('content', 'Content')}}
                {{Form::textarea('content', $post->content, ['class'=>'form-control'])}}

            </div>

            <div class="form-group">
                {{Form::label('cover_image', 'Image')}}
                {{Form::file('cover_image')}}

            </div>

            {{Form::hidden('_method', 'PUT')}}
            {{Form::submit('Submit', ['class'=>'btn btn-success'])}}

        {!! Form::close() !!}

    </div>



@endsection
