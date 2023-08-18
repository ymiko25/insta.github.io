<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryPost extends Model
{
    use HasFactory;

    protected $table = 'category_post'; // to correct the table name

    protected $fillable = ['category_id', 'post_id'];  //allow mass assignment

    public $timestamps = false; // disable the automatic timestamp created_at and updated_at

    // to get the name of category
    public function category(){
        return $this->belongsTo(Category::class);
    }

}
