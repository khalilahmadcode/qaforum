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
}
