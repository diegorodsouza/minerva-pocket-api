<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ImgurLink extends Model
{
  public static function transformImgurLink($link){
      $link = explode("imgur.com/", $link);
      $linkNovo = "https://i.imgur.com/" . $link[1] . ".jpg";
      return $linkNovo;
  }
}
