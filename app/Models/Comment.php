<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    // to ge the info of the owner of the comment
    public function user(){
        return $this->belongsTo(User::class);
    }
}
