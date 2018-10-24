<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
    $newPost->type = $type;
  }
}
