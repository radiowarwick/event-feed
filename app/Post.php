<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{

  protected $table = 'Posts';
  protected $primaryKey = 'url';
  protected $keyType = 'string';
  public $timestamps = false;
  protected $type;

  public function postType(){
    $site = $this->site();
    $type = "null";
    switch($site){
      case "twitter":
        $type = "tweet";
        break;
      case "instagram":
        $type = "instagram post";
        break;
    }
    return $type;
  }

  private function site(){
    $domain = explode('.'.$this->domain($this->url));
    return domain[0];
  }

  private function domain($url){
    $parsed = parse_url($url);
    return $parsed['host'];
  }

}
