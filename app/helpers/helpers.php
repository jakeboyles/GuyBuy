<?php
 
use Illuminate\Support\Str;
 
class Helper {
 
    public static function makeAvatar($image) {

      $imageParse = parse_url($image);

 
      if(!empty($image) && $imageParse['host'] !== 'graph.facebook.com')
      {
      	return '/avatars/'.$image;
      }
      elseif($imageParse['host']=='graph.facebook.com')
      {
        return $image;
      }
      else
      {
      	return 'http://placehold.it/350x350';
      }
 
    }
 
}
 
?>