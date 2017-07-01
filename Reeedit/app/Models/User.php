<?php

namespace App\Models;
use DateTime;
use Session;
use Illuminate\Support\Facades\DB;
  class User {
    public static function tryLogin($username, $password){
      $user = DB::select('select * from users where username = :usr',
      ['usr' => $username]);
      if (count($user) != 1)
        return false;
      if (password_verify($password, $user[0]->password))
      {
          //TODO Store session;
          Session::put('user', $user[0]);
          return true;
      }
        return false;
    }
    public static function trySignIn($username, $email, $password){
      $res = DB::insert('insert into users (email, username, password, role, createdAt, connectedAt) values
      (:email, :username, :password, :role, :createdAt, :connectedAt)',
      [
        'email' => $email,
        'username' => $username,
        'password' => password_hash($password, PASSWORD_DEFAULT),
        'role' => 'USER',
        'createdAt' => new DateTime(),
        'connectedAt' => new DateTime()
      ]);
      if ($res){
        return true;
      }else {
        return false;
      }
    }

}

?>
