<?php

namespace App\Http\Controllers;

use Abraham\TwitterOAuth\TwitterOAuth;
use Illuminate\Http\Request;
use App\Post;
use App\Article;
use App\YoutubeVideo;
use App\Tweet;

class PostController extends Controller
{

  public function getAllPostHTML(){
    $html ="";
    $posts = Post::all();
    foreach($posts as $post){
      $html = $post->generateHTML().$html;
    }
    return $html;
  }

  public function getPost(Request $request){
    $post = Post::where('id',$request->input('id'));
    return $post->generateHTML();
  }

  public function getPostPage(){
    if (is_null(auth()->user())) return redirect('login');
    return view('manage.add');
  }

  public function uploadPost(Request $request){
    if(is_null(auth()->user())) return redirect('login');
    $type = $request->input('type');
    switch($type){
      case 0:
        $this->uploadTweet($request);
        break;
      case 1:
        $this->uploadFacebook();
        break;
      case 2:
        $this->uploadArticle($request);
        break;
      case 3:
        $this->uploadPhoto();
        break;
      case 4:
        $this->uploadYoutube($request);
        break;
      case 5:
        $this->uploadInstagram($request);
        break;
    }
    return redirect()->route('feed');
  }

  public function uploadTweet(Request $request){
    # Create the connection
    $twitter = new TwitterOAuth(env("CONSUMER_KEY"), env("CONSUMER_SECRET"), env("ACCESS_TOKEN"), env("ACCESS_TOKEN_SECRET"));
    
    # Load the Tweets
    $tweet_id = $request->input('tweet-id');
    $tweets = $twitter->get('statuses/show', array('id' => $tweet_id, 'tweet_mode' => 'extended'));
    
    # Access as an object
    try{
      $tweetText = $tweets->full_text;
    } catch(\Exception $e){
      return redirect()->route('post');
    }

    
    # Make links active
    $tweetText = preg_replace("#(http://|(www.))(([^s<]{4,68})[^s<]*)#", '<a href="http://$2$3" target="_blank">$1$2$4</a>', $tweetText);
    
    # Linkify user mentions
    $tweetText = preg_replace('/(^|\s)@([a-z0-9_]+)/i', '$1<a href="http://www.twitter.com/$2" target="_blank">@$2</a>', $tweetText);
    
    # Linkify tags
    $tweetText = preg_replace('/(^|\s)#([a-z0-9_]+)/i', '$1<a href="http://twitter.com/search?q=$2" target="_blank">#$2</a>', $tweetText);



    $newPost = new Post;
    $newPost->url = $request->input('tweet-id');
    $newPost->uid = auth()->user()->getLdapAttribute("uid");
    $newTweet = new Tweet;
    $newTweet->handle = $tweets->user->screen_name;
    $newTweet->twitter_name = $tweets->user->name; 
    $newTweet->tweet_text = $tweetText;
    $newTweet->profile_image_url = $tweets->user->profile_image_url; 
    $newTweet->user_url = $tweets->user->url; 
    $newTweet->uid = auth()->user()->getLdapAttribute('uid');
    $newTweet->save();
    $newPost->type = 0;
    $newPost->url = $newTweet->id; 
    $newPost->save();
  }


  public function uploadArticle(Request $request){
    if (empty($request->input('title')) or empty($request->input('content'))) return redirect()->route('post');
    $newPost = new Post;
    $newPost->uid = auth()->user()->getLdapAttribute("uid");
    $newPost->type = 2;
    $newArticle = new Article;
    $newArticle->title = $request->input('title');
    $newArticle->text = $request->input('content'); 
    $newArticle->user = auth()->user()->name;
    $newArticle->save();
    $newPost->url = $newArticle->id; 
    $newPost->save();
  }

  public function uploadYoutube(Request $request){
    if(strlen($request->input('video'))!=11 or empty($request->input('title')) or empty($request->input('description'))) return redirect()->route('post');
    $newPost = new Post;
    $newPost->uid = auth()->user()->getLdapAttribute("uid");
    $newPost->type = 4;
    $newYoutubeVideo = new YoutubeVideo;
    $newYoutubeVideo->title = $request->input('title');
    $newYoutubeVideo->videolink = $request->input('video');
    $newYoutubeVideo->description = $request->input('description');
    $newYoutubeVideo->user = auth()->user()->name;
    $newYoutubeVideo->save();
    $newPost->url = $newYoutubeVideo->id;
    $newPost->save();
  }

  public function uploadInstagram($request){
    if (empty($request->input('instagram-id')) || strlen($request->input('instagram-id')) != 11) return redirect()->route('post');
    $newPost = new Post;
    $newPost->uid = auth()->user()->getLdapAttribute("uid");
    $newPost->type = 5;
    $newPost->url = $request->input('instagram-id');
    $newPost->save();
  }

}
