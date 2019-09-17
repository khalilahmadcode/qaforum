<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Answer; 

class VoteAnswerController extends Controller
{
    public function __contruct () {
        $this->middleware('auth'); 
    }


    // Auto call function to save the votes for answers. 
    public function __invoke(Answer $answer) {
        $vote = (int) request()->vote;
        $auth = auth()->user(); 

        if($auth ) { // if user authenticated.
            $auth->voteAnswer($answer, $vote);
        } else { // if user not logged in
            return redirect('/login'); 
        } 
        return back(); 
    }
}
