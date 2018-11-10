<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Article;

class PostController extends Controller
{

  public function getAllPostHTML(){
    $html ="";
    $posts = Post::all();
    foreach($posts as $post){
      $html = $html.$post->generateHTML();
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
        $this->uploadYoutube();
        break;
    }
    return redirect('/');
  }

  public function uploadTweet(Request $request){
    $newPost = new Post;
    $newPost->url = $request->input('tweet-id');
    $newPost->uid = auth()->user()->getLdapAttribute("uid");
    $newPost->type = 0;
    $newPost->save();
  }


  public function uploadArticle(Request $request){
    $newPost = new Post;
    $newPost->uid = auth()->user()->getLdapAttribute("uid");
    $newPost->type = 2;
    $newArticle = new Article;
    $newArticle->title = $request->input('title');
    $newArticle->text = $request->input('content'); 
    $newArticle->save();
    $newPost->url = $newArticle->id; 
    $newPost->save();
  }

  //public function uploadInstagram(){
  //  $newPost = new Post;
  //  $newPost->url = $request->input('instagram-id');
  //}

}
