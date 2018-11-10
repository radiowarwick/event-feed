<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
  protected $table = 'articles';
  protected $primaryKey = 'id';
  public $timestamps = false;
  public function getHTML(){
      $html = "<div class='row'>
        <div class='[ col-xs-12 col-sm-offset-2 col-sm-8 ]'>
          <div class='[ panel panel-default ] panel-marawthon article'>
            <div class='panel-heading'>
              <h3 style='margin-bottom: 20px;'>"
              .$this->title.
              "</h3>
              <hr>
            </div>
            <div class='panel-body'>"
            .$this->text.
            "</div>
            <div class='panel-footer'>
              <hr>
              <p class='meta' style='margin:0;'> Posted by "
            .$this->user.
            ".</p>
            </div>
          </div>
        </div>
      </div>";
    return $html;
  }
}
