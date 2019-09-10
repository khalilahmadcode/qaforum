<?php

namespace App;

use Illuminate\Database\Eloquent\Model; 
use App\Question; 
use App\User; 

class Answer extends Model
{
    protected $fillable = ['body', 'user_id']; 

    // Relationship with User
    public function user () {
        return $this->belongsTo(User::class);
    }

    // Relationship with Questions
    public function question() {
        return $this->belongsTo(Question::class); 
    }

    // Question Created date used in blade
    public function getCreatedDateAttribute() {
        return $this->created_at->diffForHumans();  
    }
    
    // Display answer body as html format used in blade.
    public function getBodyHtmlAttribute () {
        return \Parsedown::instance()->text($this->body); 
    }
}
