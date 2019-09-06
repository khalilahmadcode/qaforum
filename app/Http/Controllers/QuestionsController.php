<?php

namespace App\Http\Controllers;

use App\Question;
use Illuminate\Http\Request;
use App\Http\Requests\AskQuestionRequest; 

class QuestionsController extends Controller
{
    // Authentication middleware 
    public function __construct() {
        $this->middleware('auth', ['except'=>['index', 'show']]); 
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get all question by latest, 5 question every page. 
        $questions = Question::latest()->paginate(5); 

        // Display all question
        return view('questions.index')->with('questions', $questions);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Question object for Question model 
        $question = new Question(); 

        // Dispaly Question form
        return view('questions.create', compact('question'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AskQuestionRequest $request)
    {
        // Insert Record
        $request->user()->questions()->create($request->only('title', 'body'));

        // Redirect to all questions page.
        return redirect()->route('questions.index')->with('success', 'Your question has been submitted.'); 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question)
    {
        // Display question details
        return view('questions.show')->with('question', $question); 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $question)
    {
        // Authentication
        $this->authorize("update", $question); 

        // Show Edit page
        return view('questions.edit', compact('question')); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function update(AskQuestionRequest $request, Question $question)
    {
        // Authentication 
        $this->authorize("update", $question);

        // Validation data
        $data = $request->only('title', 'body');

        // Update data
        $question->update($data);  

        // Redirect to index
        return redirect('/questions')->with('success', 'Your question has been updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question)
    {
        // Authentication
        $this->authorize("delete", $question); 

        // Delete record 
        $question->delete(); 

        // Redirect to All Questions page.
        return redirect('/questions')->with('success', 'Your question has been deleted.'); 
    }
}
