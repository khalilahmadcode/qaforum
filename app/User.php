<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Question;
use App\Answer; 

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Relationshiop to Question
    public function questions () {
        return $this->hasMany(Question::class); 
    }

    // Relationship to Answers 
    public function answers () {
        return $this->hasMany(Answer::class); 
    }

    public function getUrlAttribute() {
        //return route('questions.show', $this->id); 
        return '#'; 
    }

    // Relationship with user's favorites questions table
    public function favorites () {
        return $this->belongsToMany(Question::class, 'favorites')->withTimestamps(); //, 'user_id', 'question_id'); 
    }

    // Relationship with question voting 
    public function voteQuestions () {
        return $this->morphedByMany(Question::class, 'votable'); 
    }

    // Relationship with answer voting 
    public function voteAnswers () {
        return $this->morphedByMany(Answer::class, 'votable'); 
    }

    // Vote a question
    public function voteQuestion(Question $question, $vote) {
        $voteQuestions = $this->voteQuestions(); 
       
        if ( $voteQuestions->where('votable_id', $question->id)->exists() ) {
            $voteQuestions->updateExistingPivot($question, ['vote' => $vote]); 
        } else {
            $voteQuestions->attach($question, ['vote' => $vote]);
        }
        
        $question->load('votes');
        
        // sum() provide -/+ number 
        $down_vote = (int) $question->downVotes()->sum('vote'); 
        $up_vote = (int) $question->upVotes()->sum('vote');
        $question->votes_count = $up_vote + $down_vote; 
        $question->save(); 
    } 

    public function voteAnswer(Answer $answer, $vote) {
        $voteAnswers = $this->voteAnswers(); 
       
        if ( $voteAnswers->where('votable_id', $answer->id)->exists() ) {
            $voteAnswers->updateExistingPivot($answer, ['vote' => $vote]); 
        } else {
            $voteAnswers->attach($answer, ['vote' => $vote]);
        }
        
        $answer->load('votes');
        
        // sum() provide -/+ number 
        $down_vote = (int) $answer->downVotes()->sum('vote'); 
        $up_vote = (int) $answer->upVotes()->sum('vote');
        $answer->votes_count = $up_vote + $down_vote; 
        $answer->save(); 
    }
}
