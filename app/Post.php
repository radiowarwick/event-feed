<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{

  protected $table = 'posts';
  protected $primaryKey = 'id';
  protected $keyType = 'string';
  public $timestamps = false;


  public function generateHTML(){
    switch($this->type){
    case 0:
      return $this->generateTweet();
      break;
    }
  }

  private function generateTweet(){
    $tweet = json_decode(file_get_contents("https://publish.twitter.com/oembed?url=https://twitter.com/Interior/status/".$this->url));
    return $tweet->html;
  }

}
