@extends('layouts.app')

@section('content')
    <div class="jumbotron text-center mt-4">
        <h1>{{$title}}</h1>
        <p>This is the laravel app from the master AmmarJT</p>
        <p>
            <a class="btn btn-primary btn-lg" href="/login" role="button">Login</a>
            <a class="btn btn-success btn-lg" href="/register" role="button">Register</a>
        </p>
    </div>
@endsection