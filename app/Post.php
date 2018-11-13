<?php

namespace App;

use Abraham\TwitterOAuth\TwitterOAuth;
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
    case 2:
      return $this->generateArticle();
      break;
    }
  }

  private function generateTweet(){
    # Create the connection
    $twitter = new TwitterOAuth(env("CONSUMER_KEY"), env("CONSUMER_SECRET"), env("ACCESS_TOKEN"), env("ACCESS_TOKEN_SECRET"));
    
    # Load the Tweets
    $tweets = $twitter->get('statuses/show', array('id' => $this->url));
    
    # Access as an object
    
    $tweetText = $tweets->text;

    
    # Make links active
    $tweetText = preg_replace("#(http://|(www.))(([^s<]{4,68})[^s<]*)#", '<a href="http://$2$3" target="_blank">$1$2$4</a>', $tweetText);
    
    # Linkify user mentions
    $tweetText = preg_replace('/(^|\s)@([a-z0-9_]+)/i', '$1<a href="http://www.twitter.com/$2" target="_blank">@$2</a>', $tweetText);
    
    # Linkify tags
    $tweetText = preg_replace('/(^|\s)#([a-z0-9_]+)/i', '$1<a href="http://twitter.com/search?q=$2" target="_blank">#$2</a>', $tweetText);
    
    $html = "<div class='row'>
              <div class='[ panel panel-default ] panel-marawthon'>
                <div class='panel-body'> "
            .$tweetText.
            "   </div> 
                <div class='panel-footer'>
                  Posted by "
                  .$tweets->user->name.
                "</div>
              </div>
            </div>";
    return $html;
    }

  

  private function generateArticle(){
    $article = Article::where('id',$this->url)->first();
    return $article->getHTML();
  }

}
