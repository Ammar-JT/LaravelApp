@extends('layouts.app')

@section('content')
    <a href="/posts" class="btn btn-outline-secondary">Go back</a>
    <h1 class="mt-3">{{$post->title}}</h1>

    @if ($post->cover_image !== 'noimage.jpg')
        <img style="width:100%" src="/storage/cover_images/{{$post->cover_image}}" alt="">
        <br><br>
    @endif
    
    <div>
        <!-- we're using { !!$post->body!! } to parse the html code when using ckeditor -->
        {!!$post->body!!}
    </div>
    <hr>
    <small>Written on {{$post->created_at}} by {{$post->user->name}}</small>
    <hr>
    @if (!Auth::guest() && Auth::user()->id == $post->user_id)
        <a href="/posts/{{$post->id}}/edit" class="btn btn-outline-secondary">Edit</a>
        {!!Form::open(['action' => ['App\Http\Controllers\PostsController@destroy', $post->id], 'method' => 'POST', 'class' => 'float-right'])!!}
            {{Form::hidden('_method', 'DELETE')}}
            {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
        {!!Form::close()!!}
    @endif
@endsection