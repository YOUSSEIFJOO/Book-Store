<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ["user_id", "book_id", "comment", "rating"];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function book()
    {
        return $this->belongsTo('App\Book', 'book_id');
    }
}
