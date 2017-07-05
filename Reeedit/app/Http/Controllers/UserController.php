<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Session;

class UserController extends Controller
{
  // Login
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
      if (\App\Models\User::tryLogin($username, $password))
        return view('welcome')->with('carderror', "You are logged in");
      else {
        return view('welcome')->with('carderror', "Login failed");
      }

    }
    return view('welcome');
  }



  //SignIn
  public function signin(Request $request){

    $validator = Validator::make($request->all(), [
      'username' => 'required|alphanum|max:25',
      'email' => 'required|max:50|email',
      'password' => 'required|alphanum|max:25'
    ]);

    if ($validator->fails()) {
      return Redirect::back()
                        ->withErrors($validator)
                        ->withInput();
    }else{
      $username = $request->input("username");
      $password = $request->input("password");
      $email = $request->input("email");
      $result = null;
      if (\App\Models\User::trySignIn($username, $email, $password)){
        $result = "Sucess";
      }
      else{
        $result = "Fail";
      }

      return view('signin', compact($result));
    }
    $result = "Fail";
    return view('signin', compact($result));
  }

  public function test(){
    return view("test");
  }
  public function logout(){
    Session::flush();
    return view("goodbye")->with('carderror', 'Logged out');
  }
}
