<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*
//this is the default route, when you go to main page it routes you to the view: 'welcome'
Route::get('/', function () {
    return view('welcome');
});


//here is our custom route, if you right the domain name/hello . It will return hello world:
Route::get('/hello', function () {
    return "hello world";
});

//this one will routes you to a real view:
Route::get('/about', function(){
    return view('pages.about');
});

//next is a dynamic route, that's one of Laravel magic:
//as you can see, you put the parameter in the url, and it will be dealt with as a parameter
// .. of this rout function:
Route::get('/users/{id}/{name}', function($id,$name){
    return "This is the user " . $name . " with an ID " . $id;
});
*/


//////// These routes are for the main pages:
//For laravel 6: Route::method('URI', 'Action(controllername@function));
//               Route::get('/', 'PagesController@index');
//for laravel 8:
//Route::method('URI', Action[controller directory::class, 'function']);
Route::get('/', [Controllers\PagesController::class, 'index'])->name('pages.index');
Route::get('/about', [Controllers\PagesController::class, 'about'])->name('pages.about');
Route::get('/services', [Controllers\PagesController::class, 'services'])->name('pages.services');

Route::resource('posts', Controllers\PostsController::class);


Auth::routes();
Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');




//-------------------------
//      Authentication
//-------------------------
/*
Try to make auth from the begining before anything,
this will install the ui for auth and also vue.js: 
    composer require laravel/ui --dev
    php artisan ui vue --auth

*/
//-------------------------
//      End of Authentication
//-------------------------


//-----------------------------------------
//      Contollers
//-----------------------------------------
// To make a controller, use the following command in the:
//      php artisan make:controller PagesController
// To make a controller with all the CRUDs functions, use the following command in the:
//      php artisan make:controller PostsController --resource
//-----------------------------------------


//-----------------------------------------
//      Migration + Models
//-----------------------------------------
// If you want to create a model use the following command:
//      php artisan make:model Post -m <<<"-m" to make a migration file>>>
//
// Also if you want to edit a column in a table of the DB, you can do it directly,
// but as a best practise, you should do it using migration: 
//      php artisan make:migration add_user_id_to_posts <<<better to be a descriptive name>>>
//      php artisan make:migration add_cover_image_to_posts
// Why <<<descriptive>>>? 
// because laravel will understand you and will prepare the migration file as you describe!!
//-----------------------------------------


//-------------------------
//      Route list
// php artisan route:list
// use this line to see all the routes list,
// and the name of every rout and what middleware is using.
//-------------------------


//-------------------------
//      Tinker
//-------------------------
/*
//you can use Tinker, which is a laravel tool to insert data to database,
//.. instead of entering it manually from mySql or from a form.
//I already used it to enter the posts info using the following code in the terminal: 

$ php artisan tinker
Psy Shell v0.10.7 (PHP 7.3.2 — cli) by Justin Hileman
>>> App\Models\Post::count()
=> 0

>>> $post = new App\Models\Post();
=> App\Models\Post {#4305}

>>> $post->title = 'Post one';
=> "Post one"

>>> $post->body = 'This is the post body';
=> "This is the post body"

>>> $post->save();
=> true

>>> $post = new App\Models\Post();
=> App\Models\Post {#4316}

>>> $post->title = 'Post Two';
=> "Post Two"

>>> $post->body = 'This is post 2';
=> "This is post 2"

>>> $post->save();
=> true
>>>
*/
//-------------------------
//      End of Tinker
//-------------------------





//-------------------------
//      Laravel UI
//-------------------------
/*
To use bootstrap and configure the UI in Laravel 8, do the following:
    1- run on terminal (not on git bash of vs code): 
        composer require laravel/ui
    2- also: 
        php artisan ui bootstrap
    3- then: 
        npm install
    4- lastly:  
        npm run dev
    GOT AN ERROR????? TRY THESE:
        run: composer install
        run: npm install
        run: npm run dev
*/
/*
The stylesheet file and the _varibles file:
The css style sheet will be in the public folder, but that file is compiled!
to put you styling, as a good practise, you should style everything in the sass folder,
and the compile it with the command "npm run dev"
*/
//-------------------------
//      End of Laravel UI
//-------------------------

