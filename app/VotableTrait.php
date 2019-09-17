<?php 


namespace App; 
trait VotableTrait {
    // Relationship with Votes
    public function votes () {
        return $this->morphToMany(User::class, 'votable'); 
    }

    // Votes up
    public function upVotes() {
        return $this->votes()->wherePivot('vote', 1);
    }

    // Votes down
    public function downVotes() {
        return $this->votes()->wherePivot('vote', -1);
    }
}