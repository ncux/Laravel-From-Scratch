@extends('layouts/app')


@section('content')

    <div class="my-2">
        <h1>Posts</h1>
        @if(count($posts) > 0)
            <ul class="list-group">
                @foreach($posts as $post)
                    <li class="list-group-item my-1">
                        <div class="row">
                            <div class="col-8">
                                <h4><a href="/posts/{{$post->id}}" target="_blank">{{$post->title}}</a></h4>
                                <small>Created on {{$post->created_at}} by {{$post->user->name}}</small>
                                <p>{{$post->content}}</p>

                            </div>

                            <div class="col-4">
                                <img src="/storage/cover_images/{{$post->cover_image}}" style="width: 100%;">

                            </div>
                        </div>


                    </li>

                @endforeach

            </ul>

            {{$posts->links()}}

            @else
            <p>No posts</p>

        @endif

    </div>



@endsection
