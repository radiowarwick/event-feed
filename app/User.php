<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    public $timestamps = false;

    use Notifiable;

    public function getLdapAttribute($attribute){
      return Adlap:search()->where('uid','=',$this->username)->get('items')->get(0)['attributes'][$attribute][0];
    }

}
