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
        $auth = auth()->user(); 

        if($auth ) {
            $auth->voteQuestion($question, $vote);
        } else {
            return redirect('/login'); 
        } 
        return back(); 
    }
}
