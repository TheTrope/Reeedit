<?php
namespace App\Models;

use DateTime;
use Session;
use Illuminate\Support\Facades\DB;
  class Thread {
    public static function GetSubs(){
      $threads = DB::select('select * from subsForums');
      return $threads;
    }
    public static function GetThreads($idsub){
      $sub = DB::table('subsForums')
              ->select('*')
              ->where('id', '=', $idsub)
              ->get();
      $threads = DB::table('threads')
              ->leftjoin('subsForums', 'threads.subId', '=', 'subsForums.id')
              ->leftJoin('threadVotes', 'threads.id', '=', 'threadVotes.threadId')
              ->select('threads.*', 'subsForums.name as subName', DB::raw('cast(sum(threadVotes.value) as signed) as votes'))
              ->where('subsForums.id', '=', $idsub)
              ->groupBy('threads.id')
              ->get();
      $result = ['sub' => $sub[0], 'threads' => $threads];
      return $result;


    }

}

?>
