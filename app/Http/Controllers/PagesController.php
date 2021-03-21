<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index(){
        ///you can pass the variable $title using one of the following  methods:
        $title = 'Welcome to Laravel';
        ///1- return view('pages.index', compact('title'));
        ///2- 
        return view('pages.index')->with('title', $title);
    }

    public function about(){
        $title = 'About Us';
        return view('pages.about')->with('title', $title);

    }

    public function services(){
        ///3-
        $data = array(
            'title' => 'Services',
            'services' => ['Web Design', 'Programming', 'SEO']
        );
        return view('pages.services')->with($data);
    }
}
