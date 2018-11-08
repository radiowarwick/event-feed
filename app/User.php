<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Adldap\Laravel\Facades\Adldap;

class User extends Authenticatable
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    public $timestamps = false;

    use Notifiable;

    public function getLdapAttribute($attribute){
      return Adldap::search()->where('uid','=',$this->username)->get('items')->get(0)['attributes'][$attribute][0];
    }

}
