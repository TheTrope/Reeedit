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

}

?>
