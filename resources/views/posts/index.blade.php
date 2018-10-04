@extends('layouts/app')


@section('content')

    <div class="my-2">
        <h1>Posts</h1>
        @if(count($posts) > 0)
            <ul class="list-group">
                @foreach($posts as $post)
                    <li class="list-group-item my-1">
                        <h4><a href="/posts/{{$post->id}}" target="_blank">{{$post->title}}</a></h4>
                        <p>{{$post->content}}</p>
                    </li>

                @endforeach

            </ul>

            {{$posts->links()}}

            @else
            <p>No posts</p>

        @endif

    </div>



@endsection