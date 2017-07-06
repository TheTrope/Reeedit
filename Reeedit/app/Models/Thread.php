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

    public static function orderAnswers($start, $answers, $depth){
        $ret = [];
        for ($i = 0; $i < count($answers); ++$i){
          if (!$answers[$i])
            continue;
          $a = $answers[$i];
          if ($a->fromAnswerId == $start){
            $answers[$i] = null;
            array_push($ret, ['data' => $a, 'depth' => $depth]);
            $rec = Thread::orderAnswers($a->id, $answers, $depth + 1);
            $ret = array_merge($ret, $rec);
          }
        }
        return $ret;
      }
    public static function GetThreadById($id){
      $usr = ((Session::has('user')? Session::get('user')->id : -1 ));
      $thread = DB::select('select *, ifnull(myVotes.value, 0) as myVote from (
                              select *, cast(sum(threadVotes.value) as signed) as votes from (
                                select threads.*, users.username as tauthor, answers.id as start, answers.fromAnswerId,
                                subsForums.name as subName, answers.content, answers.id as startAnswer from threads
                                left join subsForums on threads.subId = subsForums.id join answers on threads.id = answers.threadId
                                left join users on threads.author = users.id where answers.fromAnswerId is NULL and threads.id = :id) as t
                              left join threadVotes on t.id = threadVotes.threadId group by t.id) as d
                            left join threadVotes as myVotes on d.id = myVotes.threadId and myVotes.userId = '.$usr.'
', ["id" => $id]);


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
      $order = Thread::orderAnswers($thread[0]->start, $answers, 0);
      $result = ['thread' => $thread[0], 'answers' => $order];
      return $result;
    }

    public static function threadVote($id, $val){
      if(!Session::has('user'))
        return false;
      $vote = DB::insert("INSERT INTO threadVotes (userId, threadId, value) VALUES (:usr, :id, :val ) ON DUPLICATE KEY UPDATE value = :valcp;",
      ["usr" => Session::get('user')->id, "id" => $id, "val" => $val, "valcp" => $val]);

    }
    public static function answerVote($id, $ans, $val){
      if(!Session::has('user'))
        return false;
      $vote = DB::insert("INSERT INTO answerVotes (userId, answerId, value) VALUES (:usr, :ans, :val ) ON DUPLICATE KEY UPDATE value = :valcp;",
      ["usr" => Session::get('user')->id, "ans" => $ans, "val" => $val, "valcp" => $val]);

    }

    public static function getAnswer($id){
      $ans = DB::table('answers')
                  ->join('users', 'answers.userId', '=', 'users.id')
                  ->join('threads', 'answers.threadId', '=', 'threads.id')
                  ->select('answers.content', 'users.username', 'threads.description')
                  ->where('answers.id', '=', $id)
                  ->get();

      $res = (isset($ans[0])? $ans[0] : null);

      return $res;
    }
    public static function answerTo($tid, $aid, $content){
      $res = DB::insert('insert into answers (userId, threadid, content, fromAnswerId) values
      (:usr, :tid, :content, :aid)',
      [
        'usr' => Session::get('user')->id,
        'tid' => $tid,
        'aid' => $aid,
        'content' => $content
      ]);
      return $res;
    }

    public static function createThread($sid, $tn, $des){
      $res = DB::insert('insert into threads (author, subId, name, description) values
      (:usr, :sid, :tn, :desc)', [
        'usr' => Session::get('user')->id,
        'sid' => $sid,
        'tn' => $tn,
        'desc' => $des
      ]);
      if (!$res)
        return false;
      $res = DB::insert('insert into answers (userId, threadId) values
      (:usr, :tid)',[
        'usr' => Session::get('user')->id,
        'tid' => DB::getPdo()->lastInsertId(),
      ]);
      return $res;
    }
    public static function createSub($subname, $desc){
      $res = DB::insert('insert into subsForums (author, name, description) values
      (:usr, :subname, :desc)', [
        'usr' => Session::get('user')->id,
        'subname' => $subname,
        'desc' => $desc
      ]);
      return $res;

    }
    public static function getTop(){
      $threads = DB::table('threads')
              ->leftjoin('subsForums', 'threads.subId', '=', 'subsForums.id')
              ->leftJoin('threadVotes', 'threads.id', '=', 'threadVotes.threadId')
              ->leftJoin('answers', 'threads.id', '=', 'answers.threadId')
              ->select('threads.*', 'subsForums.name as subName', 'answers.content as content', DB::raw('cast(sum(threadVotes.value) as signed) as votes'))
              ->where('answers.fromAnswerId', '=', NULL)
              ->groupBy('threads.id', 'answers.content')
              ->orderBy('votes', 'desc')
              ->limit(5)
              ->get();
      return $threads;
    }

}

?>
