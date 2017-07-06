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

  public function formAnswerTo($tid, $aid){
    if(!Session::has('user'))
    return view('answer')->with('tid', $tid)->with('aid', $aid)->with('prevAns',
      \App\Models\Thread::GetAnswer($aid))->with('carderror', 'Please log in to answer');
    return view('answer')->with('tid', $tid)->with('aid', $aid)->with('prevAns',
      \App\Models\Thread::GetAnswer($aid));

  }
  public function answerTo(Request $request, $tid, $aid){

  if(!Session::has('user')){
      $thread = \App\Models\Thread::GetThreadById($tid);
      return Redirect::back()
                        ->with('carderror', 'Log in to answer')
                        ->withInput();
    }
    $validator = Validator::make($request->all(), [
      'content' => 'required|max:512',
    ]);

    if ($validator->fails()) {
      return Redirect::back()
                        ->with('carderror', 'Please do not exceed 512 char')
                        ->withInput();
    }else{
      $content = $request->input("content");
      if (\App\Models\Thread::answerTo($tid, $aid, $content))
        return ThreadController::viewThreadPage($tid);
      else {
        return view('welcome')->with('carderror', "Error");
      }

    }


  }
  public function formCreateThread($sub){
    if(!Session::has('user'))
      return view('createthread')->with('subid', $sub)->with('carderror', 'Please log in to answer');
    return view('createthread')->with('subid', $sub);

  }
  public function createThread(Request $request, $sid){

  if(!Session::has('user')){
      return Redirect::back()
                        ->with('carderror', 'Please log in to create a thread')
                        ->withInput();
    }
    $validator = Validator::make($request->all(), [
      'threadname' => 'required|max:80',
      'description' => 'required|max:512',
    ]);

    if ($validator->fails()) {
      return Redirect::back()
                        ->with('carderror', 'Please do not write too much caracter')
                        ->withInput();
    }else{
      $desc = $request->input("description");
      $tn = $request->input("threadname");
      if (\App\Models\Thread::createThread($sid, $tn, $desc))
        return ThreadController::threadsPage($sid);
      else {
        return view('welcome')->with('carderror', "Error");
      }

    }


  }

  public function formCreateSub(){
    if(!(Session::has('user') && Session::get('user')->role == 'ADMIN'))
      return view('subs')
            ->with('subs', \App\Models\Thread::GetSubs())
            ->with('carderror', 'You are not allowed to acces this page');
    return view('createsub');

  }
  public function createSub(Request $request){

  if(!(Session::has('user') && Session::get('user')->role == 'ADMIN')){
      return view('subs')
            ->with('subs', \App\Models\Thread::GetSubs())
            ->with('carderror', 'You are not allowed to acces this page');
    }
    $validator = Validator::make($request->all(), [
      'sub' => 'required|max:80',
      'description' => 'required|max:512',
    ]);

    if ($validator->fails()) {
      return Redirect::back()
                        ->with('carderror', 'Please do not write too much caracter')
                        ->withInput();
    }else{
      $desc = $request->input("description");
      $sub = $request->input("sub");
      if (\App\Models\Thread::createSub($sub, $desc))
      return view('subs')
            ->with('subs', \App\Models\Thread::GetSubs())
            ->with('carderror', 'Sub created');
      else {
      return view('subs')
            ->with('subs', \App\Models\Thread::GetSubs())
            ->with('carderror', 'Error');
      }

    }


  }

  public function topthread(){
      $data = \App\Models\Thread::getTop();
      return view('topthreads')->with('threads', $data);
  }
}
