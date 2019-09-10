<?php

namespace App\Http\Controllers;

use App\Answer;
use App\Question; 

use Illuminate\Http\Request;

class AnswersController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Question $question, Request $request)
    {
        $request->validate([
            'body'=>'required'
        ]); 
        
        // Check if user is logged in
        if(\Auth::id()=='') {
            return back()->with('error', 'Plesae Login first.'); 
        }
        // Save
        $question->answers()->create(['body'=> $request->body, 'user_id'=> \Auth::id()]);
        return back()->with('success', 'Your answer is submitted successfully.'); 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $question, Answer $answer)
    {
        return view('answers.edit', compact('answer', 'question')); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function update(Question $question,  Answer $answer, Request $request)
    {
        $this->authorize('update', $answer);
        $answer->update($request->validate([
            'body'=>'required'
        ])); 
        
        return redirect()->route('questions.show', $question->slug)->with('success', 'Your answer has been updated.'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question, Answer $answer)
    {
        // Authorize 
        $this->authorize('delete', $answer); 

        // Delete the answer
        $answer->delete(); 

        // Redirect withd message 
        return redirect()->route('questions.show', $question->slug)->with('success', 'The answer has been deleted successfully.'); 
    }
}
