@extends('layouts.master')

<div class="container">

  <div class="row">
    <div class="[ col-xs-12 col-sm-offset-2 col-sm-8 ]">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h4>Login with your RAW username and password</h3>
          <hr>
        </div>
        <div class="panel-body">
          <form method="POST" action="{{ route('post-login') }}">
            {{ csrf_field() }}
        	  <input type="text" class="form-control" id="username" name="username" placeholder="Username">
            <br>
        		<input type="password" class="form-control" id="password" name="password" placeholder="Password">
            <br>
            <button class="btn btn-warning" type="submit">Sign in</button>
          </form>
        </div>
      </div>
    </div>
  </div>

</div>









