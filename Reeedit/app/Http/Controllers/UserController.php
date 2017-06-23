<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{
  //
  public function login(Request $request) {
    $validator = Validator::make($request->all(), [
      'username' => 'required|alphanum|max:25',
      'password' => 'required|alphanum|max:25'
    ]);

    if ($validator->fails()) {
      return Redirect::back()
                        ->withErrors($validator)
                        ->withInput();
    }else{
      $username = $request->input("username");
      $password = $request->input("password");
      \App\Models\User::tryLogin($username, $password);

    }
    return view('welcome');
  }

  public function test(){
    return view("test");
  }
}
