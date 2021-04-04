<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use DB;
//Notice we didn't use 'App\Post' cuz in laravel 8 all the models moved to Medels folder:
use App\Models\Post;

//this one for deleing with the file storage, cuz we need it for deletion:
use Illuminate\support\Facades\Storage;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /*
    ----------------------------------------------
            Access Control & Autherization
    ----------------------------------------------
    The benifit of this middle where here in the construction is the make sure
    that the user is autherized, so if he is a guest he won't be allowed to access

    Notice that you used here 'except',
    which obviously except the functions index and show
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

    public function index()
    {
        // -----------------------------------
        //              Eloquent
        // -----------------------------------
        //When you use the model to fetch the data from DB, that's called Eloquent:
        //$posts = Post::all();
        //$post = Post::where('title','Post Two')->get();
        //$posts = Post::orderBy('created_at','desc')->take(1)->get(); <<< to limit it to 1 record >>>
        //If you don't want to use Eloquent you can fetch the data from DB,
        //.. but first you should 'use DB' above ..
        // and you can use the db simply like that:
        // $posts = DB::select('SELECT * FROM posts');

        //to get it order by time desc:
        //$posts = Post::orderBy('created_at','desc')->get();

        //same but with Pagination:
        $posts = Post::orderBy('created_at','desc')->paginate(6);
        return view('posts.index')->with('posts', $posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required',
            'cover_image' => 'image|nullable|max:1999'
        ]);

        //Handle File Upload:
        if($request->hasFile('cover_image')){ //$req and hasFile is from laravel, instead of the global variable $_POST['']

            //get filename with the extension using laravel:
            $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
            //get just file name without extension using php only:
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);

            //get ext using laravel:
            $extension = $request->file('cover_image')->getClientOriginalExtension();
            //file to store:
            $fileNameToStore = $filename.'_'.time().'.'.$extension;

            //upload image:
            ///this will actually stored at storage/app/public/cover_images/file.image:
            $path = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);
            ///..you actually wanna have a shortcut for that path in the public folder,
            ///.. so people can access the image, for that use the following instruction:
            ///.. $ php artisan storage:link

        }else{
            $fileNameToStore = 'noimage.jpg';
        }

        //create post
        $post = new Post;
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->user_id = auth()->user()->id;

        //Don't forget the cover image you fool
        $post->cover_image = $fileNameToStore;
        $post->save();

        return redirect('/posts')->with('success', 'Post Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        return view('posts.show')->with('post',$post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);

        //Check for correct user
        if(auth()->user()->id !== $post->user_id){
            return redirect('/posts')->with('error','Unautherized Page');
        }
        return view('posts.edit')->with('post',$post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        ////Same as store(), but the diff is:

        $this->validate($request, [
            'title' => 'required',
            'body' => 'required',
            'cover_image' => 'image|nullable|max:1999'
        ]);

        //Handle File Upload:
        if($request->hasFile('cover_image')){ //$req and hasFile is from laravel, instead of $_POST['']

            //get filename with the extension using laravel:
            $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
            //get just file name without extension using php only:
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);

            //get text using laravel:
            $extension = $request->file('cover_image')->getClientOriginalExtension();
            //file to store:
            $fileNameToStore = $filename.'_'.time().'.'.$extension;

            //upload image:
            ///this will actually stored at storage/app/public/cover_images/file.image:
            $path = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);
            ///..you actually wanna have a shortcut for that path in the public folder,
            ///.. so people can access the image, for that use the following instruction:
            ///.. $ php artisan storage:link

        }


        ////HERE:
        $post = Post::find($id);
        $post->title = $request->input('title');
        $post->body = $request->input('body');

        //this is if they
        if($request->hasFile('cover_image')){
            if ($post->cover_image != 'noimage.jpg') {
                Storage::delete('public/cover_images/'.$post->cover_image);
            }
            $post->cover_image = $fileNameToStore;
        }
        $post->save();

        //laravel just understand that this success is the session
        //.. you made in the inc.messages, wallahi I donno how:
        return redirect('/posts')->with('success', 'Post Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //delete post
        $post = Post::find($id);
        //Here we check for correct user:
        if(auth()->user()->id !== $post->user_id){
            return redirect('/posts')->with('error','Unauthorized Page');
        }

        if($post->cover_image != 'noimage.jpg'){
            //delete image
            Storage::delete('public/cover_images/'. $post->cover_image);
        }

        $post->delete();
        return redirect('/posts')->with('success', 'Post Deleted');


    }
}
