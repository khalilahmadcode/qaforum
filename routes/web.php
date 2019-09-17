<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', 'QuestionsController@index'); 

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//Route Questions
Route::resource('questions', 'QuestionsController')->except('show');
// Route Answers 
Route::resource('questions.answers', 'AnswersController')->except(['index', 'create', 'show']); 

Route::get('/questions/{slug}', 'QuestionsController@show')->name('questions.show');  

Route::post('/answers/{answer}/accept', 'AcceptAnswerController')->name('answers.accept'); 

// Favoriate button Route. 
Route::post('/questions/{question}/favorites', 'FavoritesController@store')->name('question.favorites');
// UnFavorite button Route.
Route::delete('/questions/{question}/favorites', 'FavoritesController@destroy')->name('question.unfavorites');

// Voting to question Route
Route::post('/questions/{question}/vote', 'VoteQuestionController'); 

// Voting to answers Route
Route::post('/answers/{answer}/vote', 'VoteAnswerController'); 