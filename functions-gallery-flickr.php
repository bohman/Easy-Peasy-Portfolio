<?php

//---------------------------------
// Flickr gallery
//
// This file ensures that we can embed a flickr set as our gallery.
// After we ensure that we have the neccessary data (flickr api key and a set id)
// we try to collect and process the data with cURL and PHP. If we don't get any data
// from cURL, we resort to a javascript fallback.
//
// This should work, but I have not yet tested this on a server without working cURL,
// so that's a small liability. The JS works fine, I'm just not 100% it triggers - it depends
// on what happens when there is no cURL.
//
// TODO: Use WP's transient API for caching.
//---------------------------------

global $post;
$epp_options = get_option('epp_theme_options');
$flickrsetid = get_post_meta($post->ID, 'flickrsetid', $single = true);
$flickrapikey = $epp_options['flickrapikey'];

if (!empty($flickrsetid) && !empty($flickrapikey)) {

  $query = 'http://api.flickr.com/services/rest/?method=flickr.photosets.getPhotos&photoset_id='. $flickrsetid .'&api_key='. $flickrapikey .'&format=json&nojsoncallback=1&extras=url_sq,url_t,url_s,url_m,url_o';

  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $query);
  curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  $ch_data = curl_exec($ch);
  curl_close($ch);

  if(!empty($ch_data)) {
    $decoded = json_decode($ch_data, true);

    if($decoded['stat'] == 'ok') {
      echo('<ul class="flickr-php gallery section">');
      foreach($decoded['photoset']['photo'] as $photo) {
        $squaresize = $photo['url_sq'];
        $thumbnailsize = $photo['url_t'];
        $smallsize = $photo['url_s'];
        $mediumsize = $photo['url_m'];
        $largesize = $photo['url_l'];
        $originalsize = $photo['url_o'];
        $photoURL = 'http://www.flickr.com/photos/'. $decoded['photoset']['owner'] .'/'. $photo['id'];
        $phototitle = $photo['title'];
        $boximage = '';

        if($largesize) {
          $boximage = $largesize;
        } else if($originalsize) {
          $boximage = $originalsize;
        } else if($mediumsize) {
          $boximage = $mediumsize;
        } else if($smallsize) {
          $boximage = $smallsize;
        } else {
          $boximage = $thumbnailsize;
        }

        if($boximage && $squaresize) { ?>

          <li>
            <a rel="gallery-<?php the_id(); ?>" title="<?php echo $phototitle; ?>" href="<?php echo $boximage; ?>">
              <img alt="<?php echo $phototitle; ?>" src="<?php echo $squaresize; ?>" />
            </a>
          </li>

        <?php }
      }
      echo('</ul>');
    }


  // Javascript fallback if cURL isn't installed or otherwise returned nothing.
  } else { ?>
    <script language="javascript" type="text/javascript">
      var apiKey = '<?php echo $flickrapikey; ?>';
      var setID = '<?php echo $flickrsetid; ?>';

      jQuery('.aside').prepend('<ul id="flickr-images" class="flickr-js gallery section"></ul>');

      function eachIt (prependTo, owner){
        return function(i,item){
          var urlPrefix = 'http://farm' + item.farm + '.static.flickr.com/' + item.server + '/' + item.id + '_' + item.secret;
          var squareSize = item.url_sq;
          var thumbnailSize = item.url_t;
          var smallSize = item.url_s;
          var mediumSize = item.url_m;
          var originalSize = item.url_o;
          var flickrURL = 'http://www.flickr.com/photos/' + owner + '/' + item.id;
          var photoTitle = item.title;

          jQuery('<li><a title="' + photoTitle + '" rel="gallery-<?php the_id(); ?>" href="' + originalSize + '"><img alt="' + photoTitle + '" src="' + squareSize + '" /></a></li>').appendTo(prependTo);
        };
      }

      jQuery.getJSON('http://api.flickr.com/services/rest/?&method=flickr.photosets.getPhotos&extras=url_sq,url_t,url_s,url_m,url_o&api_key=' + apiKey + '&photoset_id=' + setID + '&format=json&jsoncallback=?',
      function(data) {
        jQuery.each(data.photoset.photo, eachIt('#flickr-images', data.photoset.owner));
      });

      jQuery('.gallery script').remove();

    </script>
  <?php }

}