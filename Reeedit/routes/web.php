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

Route::post('/login', 'UserController@login');
Route::post('/signin', 'UserController@signin');
Route::get('/subs', 'ThreadController@subsPage');
Route::get('/threads/{id}', 'ThreadController@threadsPage');
