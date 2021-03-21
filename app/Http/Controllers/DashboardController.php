<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /*
    ----------------------------------------------
            Access Control & Autherization
    ----------------------------------------------
    The benifit of this middle where here in the construction is the make sure
    that the user is autherized, so if he is a guest he won't be allowed to access
    */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user_id = auth()->user()->id;
        $user = User::find($user_id);
                
        ///NOTICE: the $user->posts is a function you built in User.php model, which make the
        ///.. relationship between User and Post one To many:
        return view('dashboard')->with('posts', $user->posts);
    }
    
}
