<?php

namespace App;

use Abraham\TwitterOAuth\TwitterOAuth;
use Illuminate\Database\Eloquent\Model;
use App\User;

class Post extends Model
{

  protected $table = 'posts';
  protected $primaryKey = 'id';
  protected $keyType = 'string';


  public function generateHTML(){
    switch($this->type){
      case 0:
        return $this->generateTweet();
        break;
      case 2:
        return $this->generateArticle();
        break;
      case 4:
        return $this->generateYoutube();
        break;
      case 5:
        return $this->generateInstagram();
        break;
    }
  }

  private function generateTweet(){
    $tweet = Tweet::where('id',$this->url)->first();
    return $tweet->getHTML();
  }

  private function generateInstagram(){
    //$post = get('statuses/show', array('id' => $this->url));
    //https://api.instagram.com/oembed?url=http://instagr.am/p/fA9uwTtkSN/
    $post = json_decode(file_get_contents('https://api.instagram.com/oembed?url=http://instagr.am/p/'.$this->url));
    $title = $post->title;
    $authorname = $post->author_name;
    $authorurl = $post->author_url;
    $html = "
      <div class='row'>
        <div class='[ col-xs-12 col-sm-offset-2 col-sm-8 ]'>
          <div class='[ panel panel-default ] panel-marawthon photo'>
            <div class='panel-body'>
              <img src = 'https://instagram.com/p/"
                .$this->url.
              "/media/?size=l'>
              <hr style='width: 30%; margin-top: 25px;'>
              <h3>"
              .$title.
              "</h3>
            </div>
            <div class='panel-footer'>
              <hr>
              <p class='meta' style='margin: 0;'> Posted by "
              .User::where('username',$this->uid)->first()->name.
	      " on "
	     .date_format($this->created_at,"D").
	      " at "
	      .date_format($this->created_at,"H:i").
	      "<span style='float: right;'><a href='https://www.facebook.com/sharer/sharer.php?u=https://live.radio.warwick.ac.uk' target='_blank'><i class='fa fa-facebook'></a></i><a href='http://twitter.com/share?text=&url=https://live.radio.warwick.ac.uk&hashtags=marawthon18&via=raw1251am' target='_blank'><i class='fa fa-twitter' style='margin: 0 20px;'></a></i><a href='https://plus.google.com/share?url=https://live.radio.warwick.ac.uk' onclick='javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;'><i class='fa fa-google'></i></a></span></p>
            </div>
          </div>
        </div>
      </div>
    ";
    return $html;

  } 

  private function generateArticle(){
    $article = Article::where('id',$this->url)->first();
    return $article->getHTML();
  }

  private function generateYoutube(){
    $video = YoutubeVideo::where('id',$this->url)->first();
    return $video->getHTML();
  }

}
