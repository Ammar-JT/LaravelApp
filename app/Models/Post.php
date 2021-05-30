<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    /* 
    The Model class already has everything you need or at least most of it,
    so you don't really need to do any thing here,
    But if insist,  you can put:
         table name + choose a primary key 
         + set time stamp to true or false 
         + add relationship between models (forign key and primary)
         + others..
    */

    //all the following happens by default, so it won't really change anything:
    //Table Name
    protected $table = 'posts';
    //Primary Key 
    public $primarykey = 'id';
    //Timestamps
    public $timestamps = true;

    
    //this is the relationship between table, which is the foreign key and so on,
    //.. as you can see, the relation is from here not from mySql
    //.. belongsTo() means this post table has a column for
    //.. the user_id(which we wrote in the last table migration)
    //.. you used this relationship method in views/posts/index.blade.php 
    //You should also add something in the user model, go check it out.

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function images(){
        return $this->hasMany(PostImages::class);
    }

}
