<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
  <title><?php wp_title('&raquo; ',TRUE,'right'); ?><?php bloginfo('name'); ?></title>
  <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
  <?php wp_head(); ?>
</head>
<body <?php body_class('no-js'); ?>>

  <div class="nav center">

    <?php if(is_singular() || is_archive()) { ?>
      <div id="sitename">
    <?php } else { ?>
      <h1 id="sitename">
    <?php } ?>

      <a href="<?php bloginfo('url'); ?>" title="<?php bloginfo('name'); ?>">
        <span class="hidden"><?php bloginfo('name'); ?></span>
        <img 
          src="<?php header_image(); ?>"
          width="<?php echo HEADER_IMAGE_WIDTH; ?>"
          height="<?php echo HEADER_IMAGE_HEIGHT; ?>"
          alt="<?php bloginfo('name'); ?>" />
      </a>

    <?php if(is_singular() || is_archive()) { ?>
      </div>
    <?php } else { ?>
      </h1>
    <?php } ?>


    <?php wp_nav_menu( array(
      'theme_location' => 'header-menu',
      'container' => '',
      'fallback_cb' => '',
      'depth' => '1'
    )); ?>
  </div>