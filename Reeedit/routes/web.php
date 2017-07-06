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
use Illuminate\Support\Facades\Input;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/signin', function () {
    return view('signin');
});

Route::get('test', ['as' => 'about', 'uses' => 'MainController@test']);

// Users route
Route::post('/login', 'UserController@login');
Route::post('/signin', 'UserController@signin');
Route::get('/logout', 'UserController@logout');


Route::get('/subs', 'ThreadController@subsPage');
Route::get('/threads/{id}', 'ThreadController@threadsPage');
Route::get('/thread/{id}', 'ThreadController@viewThreadPage');
Route::get('/topthread', 'ThreadController@topthread');

// Votes routes
Route::get('/thread/{id}/tvoteup', 'ThreadController@threadVoteUp');
Route::get('/thread/{id}/tvotedown', 'ThreadController@threadVoteDown');
Route::get('/thread/{id}/votedown/{ans}', 'ThreadController@answerVoteDown');
Route::get('/thread/{id}/voteup/{ans}', 'ThreadController@answerVoteUp');

// Forms Routes
// -- Answers
Route::get('/answer/{tid}/{aid}', 'ThreadController@formAnswerTo');
Route::post('/answer/{tid}/{aid}', 'ThreadController@answerTo');
// -- Threads
Route::get('/createthread/{sid}', 'ThreadController@formCreateThread');
Route::post('/createthread/{sid}', 'ThreadController@createthread');
// -- Subs
Route::get('/createsub', 'ThreadController@formCreateSub');
Route::post('/createsub', 'ThreadController@createSub');
