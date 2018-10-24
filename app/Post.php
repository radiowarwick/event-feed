<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
  protected $table = 'Posts';
  protected $primaryKey = 'url';
  protected $keyType = 'string';
  public $timestamps = false;
}
