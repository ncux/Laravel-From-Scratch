@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Home</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                        <a href="/posts/create" class="btn btn-info my-3">New blog post</a>


                    @if(count($posts) > 0)
                            <h2 class="my-3">Your posts</h2>
                            <table class="table my-3">
                                <thead>
                                <td>Created on</td>  <td>Title</td>  <td></td>  <td></td>
                                </thead>
                                @foreach($posts as $post)
                                    <tr>
                                        <td>{{$post->created_at}}</td>
                                        <td>{{$post->title}}</td>
                                        <td><a href="/posts/{{$post->id}}/edit" class="btn btn-info">Edit</a></td>
                                        <td>
                                            {!! Form::open(['action'=>['PostsController@destroy', $post->id], 'method'=>'POST']) !!}

                                                {{Form::hidden('_method', 'DELETE')}}
                                                {{Form::submit('Delete', ['class'=>'btn btn-danger'])}}

                                            {!! Form::close() !!}
                                        </td>
                                    </tr>

                                @endforeach

                            </table>
                    @else
                        <p class="lead">No posts</p>
                    @endif


                </div>
            </div>
        </div>
    </div>
</div>
@endsection
