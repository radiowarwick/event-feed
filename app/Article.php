<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
  protected $table = 'articles';
  protected $primaryKey = 'id';
  public $timestamps = false;
}
