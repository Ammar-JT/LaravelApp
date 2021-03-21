@extends('layouts.app')

@section('content')
    <h1>{{$title}}</h1>
    <!-- As you can see, blade engine of larave has its own syntax,
         but you can actually use the php syntax as well: -->
    @if (count($services)>0)
        <ul class="list-group">
            @foreach ($services as $service)
                <li class="list-group-item">{{$service}}</li>
            @endforeach
        </ul>
    @endif
@endsection