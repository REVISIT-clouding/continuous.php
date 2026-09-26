<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    // protected $fillable = ['title','body'];
    #[Fillable(['title', 'body'])]

}

public function posts() {
    return $this->belongsTo(Post::class)
}