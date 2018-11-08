<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class PostController extends Controller
{

  public function getPost(Request $request){
    $post = Post::where('id',$request->input('id'));
    return $post->generateHTML();
  }

  public function uploadPost(Request $request){
    if(is_null(auth()->user())) return view('login');
    $type = $request->input('type');
    $newPost = new Post;
    $newPost->url = $request->input('url');
    $newPost->uid = $request->input(auth()->user()->getLdapAttribute("uid");
    $newPost->type = $type;
    $newPost->save();
    return view('feed');
  }
}
