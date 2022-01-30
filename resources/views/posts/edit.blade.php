@extends('layouts.dash')

<!-- CK Editor
    I tried to use the updated version but it gave me an error, 
    so i download it manually and paste it in the public folder.
    Then, I used the js files from the layout, just like when you use the bootstrap js file,
    in views/layouts/app.blade.php: 
        <script src="/ckeditor/ckeditor.js"></script>
        <script>
            CKEDITOR.replace( 'article-ckeditor' );
        </script>
-->
@section('content')
    <div class="container">
        <h1>Create Post</h1>
        @include('inc.messages')

        {!! Form::open(['action' => ['App\Http\Controllers\PostsController@update', $post->id] , 'method' => 'PUT', 'enctype' => 'multipart/form-data']) !!}
            <div class="form-group">
                {{Form::label('title', 'Title')}}
                {{Form::text('title', $post->title, ['class' => 'form-control', 'placeholder' => 'Title'])}}
            </div>
            <div class="form-group">
                {{Form::label('body', 'Body')}}
                {{Form::textarea('body', $post->body, ['id' => 'article-ckeditor', 'class' => 'form-control', 'placeholder' => 'Body Text'])}}
            </div>
            <div class="form-group">
                {{Form::file('cover_image')}}
            </div>
            <!-- you need to add this command to convince that this post request is a put request -->
            {{Form::hidden('_method', 'PUT')}}
            {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
        {!! Form::close() !!}
    </div>
    <br>
    
@endsection
