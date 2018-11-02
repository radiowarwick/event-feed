<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */


  function showLoginForm(){
    return view('auth/login');
  }

  function postLogin(Request $request){
    if(auth()->attempt($request->only(['username','password']),true)){
      return redirect()->route('/');
    }

    return redirect()->back->withErrors('Incorrect username/password, please try again');
  }

  function logout(Request $request){
    auth()->logout();
    return redirect()->route('login')->with('status','Logged out successfully');
  }
}
