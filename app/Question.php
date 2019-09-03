<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    // Question table fields goes here.
    protected $fillable = ['title', 'body']; 

    // Relationship to User
    public function user() {
        return $this->blongsTo(User::class); 
    } 

    // setting title and slug
    public function setTitleAttribute($value) {
        $this->attributes['title'] = $value;
        $this->attributes['slug'] = str_slug($value); 
    }
}
