<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'created_at', 'updated_at'];
    
    public function post(){
        return $this->belongsTo(Post::class);
    }

    public function categoryPost(){
        return $this->hasMany(CategoryPost::class);
    }
}
