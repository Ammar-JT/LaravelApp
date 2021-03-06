@extends('layouts.app')

@section('content')
    <h1>Posts</h1>
    @if (count($posts)>0)
        @foreach ($posts as $post)
        <div class="card card-body bg-light mb-2">
            <div class='row'>
                <div class='col-md-4 col-sm-4'>
                    <img style="width:100%" src="/storage/cover_images/{{$post->cover_image}}" alt="">
                </div>
                <div class='col-md-8 col-sm-8'>
                    <h3><a href="/posts/{{$post->id}}">{{$post->title}}</a></h3>
                    <!-- 
                        NOTICE: you couldn't be able to user $post->user->name if
                        if you didn't put the function user() in the model Post,
                        which contains the 'belongsTo()' method!!!!!!!!!!!
                    -->
                    <small>Written on {{$post->created_at}} by {{$post->user->name}}</small>
                </div>

            </div>      
        </div>
        @endforeach

        <!--this magical command is for pagination!-->
        {{ $posts->links() }}
    @else
        <h3>No posts found</h3>
    @endif
@endsection
