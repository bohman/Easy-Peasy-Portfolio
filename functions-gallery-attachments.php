<?php

//---------------------------------
// Attachment gallery
//
// This file handles galleries created by uploading images to a post in WordPress.
// It checks if there are any attachments, and if so loops through them and displays them
// if there are two or more.
//---------------------------------

$attachments = get_children(array(
  'post_type' => 'attachment',
  'numberposts' => -1,
  'post_status' => null,
  'post_parent' => $post->ID
));

if($attachments) {

  $i = 0;
  foreach($attachments as $count) {
    $i++;
  }

  if ($i >= 2) {
    $size = 'single-post-gallery-thumbnail';
    echo('<ul class="wp-attachments gallery section">');

    foreach($attachments as $image) {
      $attachment = wp_get_attachment_image_src($image->ID, $size); ?>
      <li>
        <a title="View a larger version of this image" rel="gallery-<?php the_id(); ?>" href="<?php echo $image->guid; ?>">
          <img alt="View a larger version of this image" src="<?php echo $attachment[0]; ?>" />
        </a>
      </li>
    <?php }

    echo('</ul>');
  }

}
