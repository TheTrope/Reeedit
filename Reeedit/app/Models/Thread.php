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
              ->leftJoin('answers', 'threads.id', '=', 'answers.threadId')
              ->select('threads.*', 'subsForums.name as subName', 'answers.content as content', DB::raw('cast(sum(threadVotes.value) as signed) as votes'))
              ->where('subsForums.id', '=', $idsub)
              ->where('answers.fromAnswerId', '=', NULL)
              ->groupBy('threads.id', 'answers.content')
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
            array_push($ret, ['data' => $a, 'depth' => $depth]);
            $rec = orderAnswers($a->id, $answers, $depth + 1);
            $ret = array_merge($ret, $rec);
          }
        }
        return $ret;
      }
      $thread = DB::table('threads')
                  ->leftjoin('subsForums', 'threads.subId', '=', 'subsForums.id')
                  ->join('answers', 'threads.id', '=', 'answers.threadId')
                  ->leftjoin('users', 'threads.author', '=', 'users.id')
                  ->leftjoin('threadVotes', 'threads.id', '=', 'threadVotes.threadId')
                  ->leftjoin('threadVotes as myVotes', 'threads.id', '=', DB::raw('threadVotes.threadId and threadVotes.userId = '. ((Session::has('user'))? Session::get('user')->id : -1 )))
                  ->select('threads.*', 'users.username as author', 'answers.id as start', 'answers.fromAnswerId', 'subsForums.name as subName', 'answers.content', 'answers.id as startAnswer',  DB::raw('cast(sum(threadVotes.value) as signed) as votes'), DB::raw('ifnull(myVotes.value, 0) as myVote'))
                  ->where('answers.fromAnswerId', '=', NULL)
                  ->where('threads.id', '=', $id)
                  ->groupBy('threads.id', 'answers.content', 'answers.id', 'myVotes.value')
                  ->get();

      $answers = DB::select("
      select id, content, fromAnswerId, username, createdAt, threadId, votes, ifnull(answerVotes.value, 0) as myVote
      from
      (
        select id, content, fromAnswerId, username, createdAt, threadId, ifnull(cast(sum(answerVotes.value) as signed), 0) as votes from
        (
          select data.id, content, fromAnswerId, username, data.createdAt, data.threadId from
          (
              select  *
              from    (select * from answers
              order by fromAnswerId, id) sorted, (select @pv := :start) initialisation
              where   find_in_set(fromAnswerId, @pv) > 0
              and     @pv := concat(@pv, ',', id)) as data
              , users
              where data.userId = users.id
        ) as finalData
        left join answerVotes on finalData.id = answerVotes.answerId
        group by finalData.id
      ) as reallyNowItsFinalData
      left join answerVotes on reallyNowItsFinalData.id = answerVotes.answerId and answerVotes.userId = :idusr
        ", ["start" => $thread[0]->start, "idusr" => ((Session::has('user'))? Session::get('user')->id : -1 )]);
      $order = orderAnswers($thread[0]->start, $answers, 0);
      $result = ['thread' => $thread[0], 'answers' => $order];
      return $result;
    }


}

?>
