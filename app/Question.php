<?php

namespace App;
use App\User; 
use App\Answer; 
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    // votableTrait.php
    use VotableTrait; 
    
    // Question table fields goes here.
    protected $fillable = ['title', 'body']; 

    // Relationship to User
    public function user() {
        return $this->belongsTo(User::class); 
    } 

    // Relationship to Answer
    public function answers() {
        return $this->hasMany(Answer::class)->orderBy('votes_count', 'DESC'); 
    }

    // Setting title and slug 
    public function setTitleAttribute($value) {
        $this->attributes['title'] = $value;
        $this->attributes['slug'] = str_slug($value); 
    }

    // Question show url used in blade
    public function getUrlAttribute() {
        return route('questions.show', $this->slug); 
    }

    // Question Created date used in blade
    public function getCreatedDateAttribute() {
        return $this->created_at->diffForHumans();  
    }

    // Question Status style used in blade.
    public function getStatusAttribute() {
        if($this->answers_count > 0) {
            if($this->best_answer_id) {
                return "answered-accepted";  
            }
            return "answered"; 
        }
        return "unanswered"; 
    }

    // Display question body as html format used in blade.
    public function getBodyHtmlAttribute () {
        return $this->htmlBody();
    }

    public function acceptBestAnswer(Answer $answer) {
        // $this->where('id',$this->id).update(['best_answer_id'=>$answer->id]); 
        $this->best_answer_id = $answer->id; 
        $this->save(); 
        
    }

    // Relationship with user favorites questoins 
    public function favorites() {
        return $this->belongsToMany(User::class, 'favorites')->withTimestamps(); //, 'question_id', 'user_id'); 
    }

    // Favorited Question
     public function isFavorited () {
        return $this->favorites()->where('user_id', auth()->id())->count() > 0; 
    }

    // Check if the question is favorited already. 
    public function getIsFavoritedAttribute() {
       return $this->isFavorited(); 
    }

    // Favorite count
    public function getFavoritesCountAttribute() {
       return $this->favorites->count(); 
    } 

    public function getExcerptAttribute() {
        return $this->excerpt(250);
    }

    public function excerpt($length) {
        return str_limit(strip_tags($this->htmlBody()), $length);
    }

    private function htmlBody() {
        return \Parsedown::instance()->text($this->body); 
    }
}
