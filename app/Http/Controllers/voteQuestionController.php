<?php

namespace App\Http\Controllers;
use App\Question;
use Illuminate\Http\Request;

class voteQuestionController extends Controller
{
    public function __construc() {
        $this->middleware('auth'); 
    }

    // auto call function 
    public function __invoke(Question $question) {
        $vote = (int) request()->vote; 
        
        auth()->user()->voteQuestion($question, $vote);

        return back(); 
    }
}
