<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = ["name", "image_book", "desc", "lang", "file_book", "author_id", "category_id"];
    protected $appends = ["rating_book"];

    public function author()
    {
        return $this->belongsTo('App\Author', 'author_id');
    }

    public function category()
    {
        return $this->belongsTo('App\Category', 'category_id');
    }

    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

    public function getRatingBookAttribute() {

        $rating = Comment::where('book_id', $this->id)->selectRaw('SUM(rating)/COUNT(user_id) AS avg_rating')->first()->avg_rating;
        return round($rating, 2);
    }
}
