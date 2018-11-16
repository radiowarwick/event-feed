<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class YoutubeVideo extends Model
{
  protected $table = 'youtube_videos';
  protected $primaryKey = 'id';
  public $timestamps = false;
  public function getHTML(){
    $html = "
     <div class='row'>
            <div class='[ col-xs-12 col-sm-offset-2 col-sm-8 ]'>
              <div class='[ panel panel-default ] panel-marawthon youtube'>
                <div class='panel-body'>
                  <iframe width='100%' height='auto' src='https://www.youtube.com/embed/"
                  .$this->videolink.
                "?rel=0&amp;controls=0&amp;showinfo=0' frameborder='0' allow='autoplay; encrypted-media' allowfullscreen></iframe>
                </div>
                <div class='panel-footer'>
                  <h3 style='margin-bottom: 10px;'>"
                  .$this->title.

                "</h3>"
                .$this->description.
                "<hr>
                  <p class='meta' style='margin: 0;'>"
                .$this->user.
                "<span style='float: right;'><a href='https://www.facebook.com/sharer/sharer.php?u=https://live.radio.warwick.ac.uk' target='_blank'><i class='fa fa-facebook'></a></i><a href='http://twitter.com/share?text=&url=https://live.radio.warwick.ac.uk&hashtags=marawthon18&via=raw1251am' target='_blank'><i class='fa fa-twitter' style='margin: 0 20px;'></a></i><a href='https://plus.google.com/share?url=https://live.radio.warwick.ac.uk' onclick='javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;'><i class='fa fa-google'></i></a></span></p>
                </div>
              </div>
            </div>
          </div> 
    ";
    return $html;


  }
}
