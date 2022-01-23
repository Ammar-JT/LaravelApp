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


    @if ($post->images)
        <hr>
    @endif

    @if (!Auth::guest() && Auth::user()->id == $post->user_id)
        <a class="btn btn-info btn-block mb-2" type="button" data-toggle="modal" data-target="#addImage">اضافة صورة</a>
    @endif

    <div class="row justify-content-center">
        @if ($post->images)
            @foreach ($post->images as $image)
                <div class="col-md-2">
                    <img style="width:100%" src="/storage/post_images/{{$image->file_name}}" alt="">                    
                </div>
            @endforeach
        @endif
        
    </div>
    

    
    
    <hr>
    <small>Written on {{$post->created_at}} by {{$post->user->name}}</small>
    <hr>
    <div class = "mb-4">
        @if (!Auth::guest() && Auth::user()->id == $post->user_id)
            <a href="/posts/{{$post->id}}/edit" class="btn btn-outline-secondary">Edit</a>
            {!!Form::open(['action' => ['App\Http\Controllers\PostsController@destroy', $post->id], 'method' => 'POST', 'class' => 'float-right'])!!}
                {{Form::hidden('_method', 'DELETE')}}
                {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
            {!!Form::close()!!}
        @endif
    </div>





    <!-- Add Menu Modal -->
    <div class="modal fade" id="addImage" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                {!! Form::open(['action' => ['App\Http\Controllers\PostsController@addImage', $post->id] , 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                    <div class="modal-header">
                        <div class="float-right">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div> 
                        <h5>Add Image</h5>
                        
                    </div>
                    <div class="modal-body">
                        <p>Image File</p>
                        <div class="custom-file mb-3">
                            {{Form::file('image_file', ['class' => 'form-control',
                            'placeholder' => '',
                            'class' => 'custom-file-input',
                            'accept' => "image/*"])}}
                            <label class="custom-file-label" for="image_file">Only Images</label>
                        </div>
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        {{Form::submit('Submit', ['class' => 'btn btn-success'])}}
                    </div>
                {!! Form::close() !!}

                
                
            </div>
        </div>
    </div>
@endsection



@section('script')
<script>
    $(".custom-file-input").on("change",function(){
        var fileName= $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });
</script>
@endsection


