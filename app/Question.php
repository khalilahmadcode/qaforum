<?php

namespace App;
use App\User; 
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    // Question table fields goes here.
    protected $fillable = ['title', 'body']; 

    // Relationship to User
    public function user() {
        return $this->belongsTo(User::class); 
    } 

    // setting title and slug
    public function setTitleAttribute($value) {
        $this->attributes['title'] = $value;
        $this->attributes['slug'] = str_slug($value); 
    }

    public function getUrlAttribute() {
        return route('questions.show', $this->slug); 
    }

    public function getCreatedDateAttribute() {
        return $this->created_at->diffForHumans();  
    }

    public function getStatusAttribute() {
        if($this->answers > 0) {
            if($this->best_answer_id) {
                return "answered-accepted";  
            }
            return "answered"; 
        }
        return "unanswered"; 
    }

    public function getBodyHtmlAttribute () {
        return \Parsedown::instance()->text($this->body); 
    }
}
