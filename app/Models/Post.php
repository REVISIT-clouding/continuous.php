<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

#[Fillable(['title', 'body'])]
class Post extends Model
{
    
    public function posts() {
        return $this->belongsTo(Post::class);
    }
    // protected $fillable = ['title','body'];
}