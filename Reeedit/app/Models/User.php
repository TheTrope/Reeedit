<?php

namespace App\Models;
use Illuminate\Support\Facades\DB;
  class User {
    public static function tryLogin($username, $password){
      $user = DB::select('select * from users where username = :usr and password = :pass',
      ['usr' => $username, 'pass' => $password]);
      if (password_verify($password, $user['password']))
      {
          //TODO Store session;
          return true;
      }
        return false;
    }

}

?>
