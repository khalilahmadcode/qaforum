<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Question; 

class FavoritesController extends Controller
{
    public function __construct() {
        $this->middleware('auth'); 
    }

    // Do Favorite
    public function store(Question $question) {
        $question->favorites()->attach( auth()->id() ); 
        return back(); 
    }

    // Do unFavorite
    public function destroy(Question $question) {
        $question->favorites()->detach(auth()->id());
        return back(); 
    }
}
