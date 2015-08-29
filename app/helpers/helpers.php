<?php
 
use Illuminate\Support\Str;
 
class Helper {
 
    public static function makeAvatar($image) {
 
      if(!empty($image))
      {
      	return '/avatars/'.$image;
      }
      else
      {
      	return 'http://placehold.it/350x350';
      }
 
    }
 
}
 
?>