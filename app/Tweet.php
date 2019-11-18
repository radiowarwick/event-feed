<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tweet extends Model
{
  protected $table = 'tweets';
  public function getHTML(){
    $html = "<div class='row'>
              <div class='[ col-xs-12 col-sm-offset-2 col-sm-8 ]'>
              <div class='[ panel panel-default ] panel-marawthon'>
                <div class='panel-heading'>
                  <img class='[ profile-img ]' src='"
                  .$this->profile_image_url.
                  "'>
                  <h5><span><a href='".$this->user_url."'>@".$this->handle."</a></span></h5>
                </div>
                <hr style='width: 30%; margin-bottom: 25px;'>
                <div class='panel-body'> "
            .$this->tweet_text.
            "   </div> 
                <div class='panel-footer'>
                  <hr>
                  <p class='meta' style='margin:0;'>
                  Posted by "
                  .User::where('username',$this->uid)->first()->name.
		  " on "
		  .date_format($this->created_at,"l").
		  " at "
		  .date_format($this->created_at,"H:i").
                  "</p>
                  </div>
              </div>
              </div>
            </div>";
    return $html;
  }
}
