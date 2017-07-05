<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Session;

class ThreadController extends Controller
{

  public function subsPage(Request $request) {
    $subs = \App\Models\Thread::GetSubs();
    return view("subs")->with("subs", $subs);
  }
  public function threadsPage($idsubs) {
    $data = \App\Models\Thread::GetThreads($idsubs);
    return view("threads")->with("data", $data);
  }
  public function viewThreadPage($id) {
    $thread = \App\Models\Thread::GetThreadById($id);
    return view('viewThread')->with('data', $thread);
  }
  public function threadVoteUp($id){
    if(!Session::has('user')){
      $thread = \App\Models\Thread::GetThreadById($id);
      return view('viewThread')->with('data', $thread)->with('carderror', "Please log in to vote");
    }
    \App\Models\Thread::ThreadVote($id, 1);
    $thread = \App\Models\Thread::GetThreadById($id);
    return view('viewThread')->with('data', $thread);
  }
  public function threadVoteDown($id){

    if(!Session::has('user')){
      $thread = \App\Models\Thread::GetThreadById($id);
      return view('viewThread')->with('data', $thread)->with('carderror', "Please log in to vote");
    }
    \App\Models\Thread::ThreadVote($id, -1);
    $thread = \App\Models\Thread::GetThreadById($id);
    return view('viewThread')->with('data', $thread);
  }
  public function answerVoteUp($id, $ans){

    if(!Session::has('user')){
      $thread = \App\Models\Thread::GetThreadById($id);
      return view('viewThread')->with('data', $thread)->with('carderror', "Please log in to vote");
    }
    \App\Models\Thread::AnswerVote($id, $ans, 1);
    $thread = \App\Models\Thread::GetThreadById($id);
    return view('viewThread')->with('data', $thread);
  }
  public function answerVoteDown($id, $ans){

    if(!Session::has('user')){
      $thread = \App\Models\Thread::GetThreadById($id);
      return view('viewThread')->with('data', $thread)->with('carderror', "Please log in to vote");
    }
    \App\Models\Thread::AnswerVote($id,$ans, -1);
    $thread = \App\Models\Thread::GetThreadById($id);
    return view('viewThread')->with('data', $thread);
  }

}
