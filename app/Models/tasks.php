<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class tasks extends Model
{
    public function user() {
        return $this->belongTo(User::class)
    }
    public function project() {
        return $this->belongTo(Project::class)
    }
}
