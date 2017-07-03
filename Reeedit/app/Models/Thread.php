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

    public static function GetThreadById($id){
      function orderAnswers($start, $answers, $depth){
        $ret = [];
        for ($i = 0; $i < count($answers); ++$i){
          if (!$answers[$i])
            continue;
          $a = $answers[$i];
          if ($a->fromAnswerId == $start){
            $answers[$i] = null;
            array_push($ret, ['data' => $a, 'dept' => $depth]);
            $rec = orderAnswers($a->id, $answers, $depth + 1);
            $ret = array_merge($ret, $rec);
          }
        }
        return $ret;
      }
      $thread = DB::table('threads')
                  ->join('answers', 'threads.id', '=', 'answers.threadId')
                  ->select('threads.*','answers.id as start', 'answers.fromAnswerId')
                  ->where('answers.fromAnswerId', '=', NULL)
                  ->where('threads.id', '=', $id)
                  ->get();
      var_dump($thread[0]);
      $answers = DB::select(" select  *
      from    (select * from answers
      order by fromAnswerId, id) sorted,
      (select @pv := :start) initialisation
      where   find_in_set(fromAnswerId, @pv) > 0
      and     @pv := concat(@pv, ',', id)", ["start" => $thread[0]->start]);
      $order = orderAnswers($thread[0]->start, $answers, 0);
      $result = ['thread' => $thread[0], 'answers' => $order];
    }


}

?>
