<?php

//---------------------------------
// Custom fields gallery
//
// This file handles and outputs all of the custom field images.
// First we gather all of the data, and if we have two or more images,
// we display them all. We don't want to show a gallery with only one
// image, because then the large top image is enough.
//---------------------------------

global $post;
$thumb3 = get_post_meta($post->ID, 'thumb3', $single = true);
$thumb4 = get_post_meta($post->ID, 'thumb4', $single = true);
$thumb5 = get_post_meta($post->ID, 'thumb5', $single = true);
$thumb6 = get_post_meta($post->ID, 'thumb6', $single = true);
$thumb7 = get_post_meta($post->ID, 'thumb7', $single = true);
$thumb8 = get_post_meta($post->ID, 'thumb8', $single = true);
$thumb9 = get_post_meta($post->ID, 'thumb9', $single = true);
$thumb10 = get_post_meta($post->ID, 'thumb10', $single = true);
$thumb11 = get_post_meta($post->ID, 'thumb11', $single = true);
$thumb12 = get_post_meta($post->ID, 'thumb12', $single = true);
$thumb3link = get_post_meta($post->ID, 'thumb3link', $single = true);
$thumb4link = get_post_meta($post->ID, 'thumb4link', $single = true);
$thumb5link = get_post_meta($post->ID, 'thumb5link', $single = true);
$thumb6link = get_post_meta($post->ID, 'thumb6link', $single = true);
$thumb7link = get_post_meta($post->ID, 'thumb7link', $single = true);
$thumb8link = get_post_meta($post->ID, 'thumb8link', $single = true);
$thumb9link = get_post_meta($post->ID, 'thumb9link', $single = true);
$thumb10link = get_post_meta($post->ID, 'thumb10link', $single = true);
$thumb11link = get_post_meta($post->ID, 'thumb11link', $single = true);
$thumb12link = get_post_meta($post->ID, 'thumb12link', $single = true); ?>

  <ul class="custom-fields gallery section">
    <li>
      <a title="View a larger version of this image" rel="gallery-<?php the_id(); ?>" href="<?php echo $thumb1link ?>">
        <img alt="View a larger version of this image" src="<?php echo $thumb1; ?>" />
      </a>
    </li>

    <li>
      <a title="View a larger version of this image" rel="gallery-<?php the_id(); ?>" href="<?php echo $thumb2link ?>">
        <img alt="View a larger version of this image" src="<?php echo $thumb2; ?>" />
      </a>
    </li>

    <?php if ($thumb3 && $thumb3link) { ?>
      <li>
        <a title="View a larger version of this image" rel="gallery-<?php the_id(); ?>" href="<?php echo $thumb3link ?>">
          <img alt="View a larger version of this image" src="<?php echo $thumb3; ?>" />
        </a>
      </li>
    <?php }

    if ($thumb4 && $thumb4link) { ?>
      <li>
        <a title="View a larger version of this image" rel="gallery-<?php the_id(); ?>" href="<?php echo $thumb4link ?>">
          <img alt="View a larger version of this image" src="<?php echo $thumb4; ?>" />
        </a>
      </li>
    <?php }

    if ($thumb5 && $thumb5link) { ?>
      <li>
        <a title="View a larger version of this image" rel="gallery-<?php the_id(); ?>" href="<?php echo $thumb5link ?>">
          <img alt="View a larger version of this image" src="<?php echo $thumb5; ?>" />
        </a>
      </li>
    <?php }

    if ($thumb6 && $thumb6link) { ?>
      <li>
        <a title="View a larger version of this image" rel="gallery-<?php the_id(); ?>" href="<?php echo $thumb6link ?>">
          <img alt="View a larger version of this image" src="<?php echo $thumb6; ?>" />
        </a>
      </li>
    <?php }

    if ($thumb7 && $thumb7link) { ?>
      <li>
        <a title="View a larger version of this image" rel="gallery-<?php the_id(); ?>" href="<?php echo $thumb7link ?>">
          <img alt="View a larger version of this image" src="<?php echo $thumb7; ?>" />
        </a>
      </li>
    <?php }

    if ($thumb8 && $thumb8link) { ?>
      <li>
        <a title="View a larger version of this image" rel="gallery-<?php the_id(); ?>" href="<?php echo $thumb8link ?>">
          <img alt="View a larger version of this image" src="<?php echo $thumb8; ?>" />
        </a>
      </li>
    <?php }

    if ($thumb9 && $thumb9link) { ?>
      <li>
        <a title="View a larger version of this image" rel="gallery-<?php the_id(); ?>" href="<?php echo $thumb9link ?>">
          <img alt="View a larger version of this image" src="<?php echo $thumb9; ?>" />
        </a>
      </li>
    <?php }

    if ($thumb10 && $thumb10link) { ?>
      <li>
        <a title="View a larger version of this image" rel="gallery-<?php the_id(); ?>" href="<?php echo $thumb10link ?>">
          <img alt="View a larger version of this image" src="<?php echo $thumb10; ?>" />
        </a>
      </li>
    <?php }

    if ($thumb11 && $thumb11link) { ?>
      <li>
        <a title="View a larger version of this image" rel="gallery-<?php the_id(); ?>" href="<?php echo $thumb11link ?>">
          <img alt="View a larger version of this image" src="<?php echo $thumb11; ?>" />
        </a>
      </li>
    <?php }

    if ($thumb12 && $thumb12link) { ?>
      <li>
        <a title="View a larger version of this image" rel="gallery-<?php the_id(); ?>" href="<?php echo $thumb12link ?>">
          <img alt="View a larger version of this image" src="<?php echo $thumb12; ?>" />
        </a>
      </li>
    <?php } ?>
  </ul>