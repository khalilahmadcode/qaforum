<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\question; 
use App\User; 

class Answer extends Model
{
    // Relationship with User
    public function user () {
        return $this->belongsTo(User::class);
    }

    // Relationship with Questions
    public function question() {
        return $this->belongsTo(Question::class); 
    }

    // Display answer body as html format used in blade.
    public function getBodyHtmlAttribute () {
        return \Parsedown::instance()->text($this->body); 
    }
}
