<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User; 
use App\Question;
use App\Answer; 
use Illuminate\Support\Facades\DB;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Question $question, Answer $answer)
    {
        // $qs = $question->user; 
        // echo 'test'; 
        // print_r($qs);
        // die; 
        $user = auth()->user();
        $questions = DB::table('questions')->where('user_id', $user->id)->get();
        return view('home')->with([
            'user'=>$user, 
            'questions'=>$questions
        ]);
    }
}
