<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Answer; 

class AcceptAnswerController extends Controller
{
   public function __invoke(Answer $answer) {
        // Authorize
        $this->authorize('accept', $answer); 

        // Call 
        $answer->question->acceptBestAnswer($answer); 

        // Redirect back
        return back(); 
    }
}