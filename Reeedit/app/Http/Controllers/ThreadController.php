<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;

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
    return view('viewThread')->with('thread', $thread);
  }

}
