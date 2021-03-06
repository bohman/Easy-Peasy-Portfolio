<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
  <meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
  <title><?php wp_title('&raquo; ', TRUE, 'right'); ?><?php bloginfo('name'); ?></title>
  <script>
    document.documentElement.className = document.documentElement.className.replace(/(\s|^)no-js(\s|$)/, '$1' + 'js' + '$2');
  </script>
  <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
  <?php wp_head(); ?>
  <!--[if (gte IE 6)&(lte IE 8)]>
    <script type="text/javascript" src="<?php echo get_bloginfo('template_directory') . '/js/selectivizr-min.js'; ?>"></script>
  <![endif]-->
</head>
<body <?php body_class(); ?>>

  <div class="nav center">

    <?php if(is_singular() || is_archive()) { ?>
      <div id="sitename" class="header">
    <?php } else { ?>
      <h1 id="sitename" class="header">
    <?php } ?>

      <a href="<?php bloginfo('url'); ?>" title="<?php bloginfo('name'); ?>">
        <?php if(get_header_image()) { ?>
          <img
            src="<?php header_image(); ?>"
            width="<?php echo HEADER_IMAGE_WIDTH; ?>"
            height="<?php echo HEADER_IMAGE_HEIGHT; ?>"
            alt="<?php bloginfo('name'); ?>" />
        <?php } else {
          bloginfo('name');
        } ?>
      </a>

    <?php if(is_singular() || is_archive()) { ?>
      </div>
    <?php } else { ?>
      </h1>
    <?php }

    wp_nav_menu( array(
      'theme_location' => 'header-menu',
      'container' => '',
      'fallback_cb' => '',
      'depth' => '1',
      'walker' => new EPP_Menu_Walker
    )); ?>
  </div>