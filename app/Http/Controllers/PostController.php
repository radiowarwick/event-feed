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
    $type = $request->input('type');
    $newPost = new Post;
    $newPost->url = $request->input('url');
    $newPost->uid = $request->input('uid');
    $newPost->type = $type;
    $newPost->save();
    return view('feed');
  }
}
