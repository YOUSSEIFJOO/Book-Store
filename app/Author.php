<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    protected $fillable = ["first_name", "last_name", "image", "about_him"];

    public function books()
    {
        return $this->hasMany('App\Book');
    }
}
