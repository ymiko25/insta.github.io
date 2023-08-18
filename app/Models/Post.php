<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory, SoftDeletes;

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function categories(){
        return $this->hasMany(User::class);
    }
    
    // to get the categories under a post
    public function categoryPost(){
        return $this->hasMany(CategoryPost::class);
    }

    // to get all the comments
    public function comments(){
        return $this->hasMany(Comment::class);
    }

    public function likes(){
         return $this->hasMany(Like::class);
    }

    public function isLiked(){
        return $this->likes()->where('user_id', Auth::user()->id)->exists();
    }
}
