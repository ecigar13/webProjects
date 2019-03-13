<?php
require_once('flickr.php');
$Flickr = new Flickr('78dc2b13d9cc1127139a1aa12bf9fcc6');
$data = $Flickr->search('funny dogs');
foreach ($data['photos']['photo'] as $photo) {
  // the image URL becomes somthing like
  // http://farm{farm-id}.static.flickr.com/{server-id}/{id}_{secret}.jpg
  echo '<a href="' . 'http://farm' . $photo["farm"] . '.static.flickr.com/' . $photo["server"] . '/' . $photo["id"] . '_' . $photo["secret"] . '.jpg"><img src="' . 'http://farm' . $photo["farm"] . '.static.flickr.com/' . $photo["server"] . '/' . $photo["id"] . '_' . $photo["secret"] . '_t.jpg"></a>';
}
?>