<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
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
    $this->validate($request, [
        'username' => 'required',
        'password' => 'required',
    ]);

    if (auth()->attempt($request->only(['username', 'password']), true)) {
			return redirect()->route('feed');
		}
		return redirect()->back()->withErrors(
			 'Username and/or Password is wrong!'
		);
  }

  function logout(Request $request){
    auth()->logout();
    return redirect()->route('feed');
  }
}
