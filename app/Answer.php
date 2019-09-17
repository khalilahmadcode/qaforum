<?php

namespace App;

use Illuminate\Database\Eloquent\Model; 
use App\Question; 
use App\User; 

class Answer extends Model
{
    // votableTrait.php
    use VotableTrait; 

    // fillables
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

    public static function boot() {
        parent::boot(); 

        // Increment Answer count in Question table 
        static::created(function($answer) {
            $answer->question->increment('answers_count'); 
        }); 

        // Decrement Answer count in Question table 
        static::deleted(function($answer) {
            $answer->question->decrement('answers_count');
        }); 
    } // boot()

    public function getStatusAttribute () {
        return $this->isBest() ? 'vote-accepted': ''; 
    }

    public function getIsBestAttribute() {
        return $this->isBest(); 
    }

    public function isBest() {
        return $this->id == $this->question->best_answer_id; 
    }

    //
}
