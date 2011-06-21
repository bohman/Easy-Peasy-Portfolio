<?php

  //---------------------------------
  // Javascripts & CSS
  //---------------------------------

  function epp_add_css() {
    if(!is_admin()) {
      wp_enqueue_style('epp', get_bloginfo('stylesheet_url'), false, 'screen');
      wp_enqueue_style('fonts-yanone', 'http://fonts.googleapis.com/css?family=Yanone+Kaffeesatz:regular,bold', false, 'screen');
    }
  }

  function epp_enqueue_scripts() {
    if(!is_admin()) {
      wp_enqueue_script('utilities', get_bloginfo('template_directory') . '/js/epp.js', array('jquery'));
      wp_enqueue_script('easyrotation', get_bloginfo('template_directory') . '/js/easyrotate.js', array('jquery'));
      wp_enqueue_script('colorbox', get_bloginfo('template_directory') . '/js/colorbox.js', array('jquery'), '1.3.9');
      wp_enqueue_script('labelify', get_bloginfo('template_directory') . '/js/labelify.js', array('jquery'), '1.3');
    }
  }

  add_action('wp_print_styles', 'epp_add_css');
  add_action('wp_enqueue_scripts', 'epp_enqueue_scripts');


  //---------------------------------
  // Admin settings
  //---------------------------------

  if(is_admin()) {
    require_once('admin/option-page.php');
    require_once('admin/settings.php');
  }


  //---------------------------------
  // Theme supports and other WordPress functionality
  //
  // Activates certain WordPress functions. EPP uses:
  // - Thumbnails
  // - Automatic feed links
  // - Menus
  // - Custom backgrounds (though, to be honest, I hope you don't have to use it - better to change it in CSS)
  //---------------------------------

  if(function_exists('add_theme_support')) {
    add_theme_support('post-thumbnails');
    add_theme_support('automatic-feed-links');
    add_theme_support('menus');
  }

  if(function_exists('add_custom_background')) {
    add_custom_background();
  }


  //---------------------------------
  // Header image
  //---------------------------------

  define('HEADER_TEXTCOLOR', '');
  define('NO_HEADER_TEXT', true);
  define('HEADER_IMAGE_WIDTH', apply_filters('epp_header_image_width', 243));
  define('HEADER_IMAGE_HEIGHT', apply_filters('epp_header_image_height', 100));

  set_post_thumbnail_size(HEADER_IMAGE_WIDTH, HEADER_IMAGE_HEIGHT, true);
  add_custom_image_header('', 'epp_admin_header_style');
  register_default_headers(array(
    'linusbohman' => array(
      'url' => '%s/img/header/linusbohman.png',
      'thumbnail_url' => '%s/img/header/linusbohman.png',
      'description' => __('Linus Bohman', 'epp')
    )
  ));

  function epp_admin_header_style() { ?>
    <style type="text/css">
      #available-headers img,
      #headimg {
        background-color: #677079;
      }
    </style>
  <?php }


  //---------------------------------
  // Menus
  //
  // Registers the menu locations. You have to
  // create the menu yourself from the interface.
  //---------------------------------

  function epp_register_menu() {
    register_nav_menu('header-menu', __('Header menu'));
  }

  add_action('init', 'epp_register_menu');


  //---------------------------------
  // Sidebars
  //
  // Creates widget areas. Call them in your theme with
  // the following function: dynamic_sidebar('Name1');
  // Don't forget to write awesomely helpful descriptions.
  //---------------------------------

  if(function_exists('register_sidebar')) {
    register_sidebar(array(
      'name' => 'Left footer',
      'description' => 'Left part of the footer',
      'id' => 'left-footer',
      'before_widget' => '<li id="%1$s" class="wysiwyg widget %2$s">',
      'after_widget'  => '</li>'
    ));
    register_sidebar(array(
      'name' => 'Middle footer',
      'description' => 'Middle part of the footer',
      'id' => 'middle-footer',
      'before_widget' => '<li id="%1$s" class="wysiwyg widget %2$s">',
      'after_widget'  => '</li>',
    ));
    register_sidebar(array(
      'name' => 'Right footer',
      'description' => 'Right part of the footer',
      'id' => 'right-footer',
      'before_widget' => '<li id="%1$s" class="wysiwyg widget %2$s">',
      'after_widget'  => '</li>',
    ));
  }


  //---------------------------------
  // Image sizes
  //
  // Adding some image sizes to be used for featured images.
  // Hardcoded to make sure they fit the layout. Please note:
  // due to WordPress limitations sizes are only generated
  // for new images - old images needs to be re-uploaded or
  // remade using the following plugin:
  // http://wordpress.org/extend/plugins/regenerate-thumbnails/
  //---------------------------------

  add_image_size('single-post-gallery-thumbnail', 75, 75, true);
  add_image_size('archive-featured-image', 240, 240);
  add_image_size('single-post-featured-image', 800, 700);


  //---------------------------------
  // Easy Peasy featured image
  //
  // Determines where to get the featured image from,
  // and in what size (depends if we're looking at a list
  // or a single post). Can only be used inside the loop.
  //
  // Order of priority:
  // 1. Featured image in WordPress
  // 2. Flickr set ID (first image from the set)
  // 3. Custom fields (thumb1link - will make the loading time on archives quite high, but is the best we can do)
  // 4. A pseudo image made by a styled div containing the post title
  //---------------------------------

  function epp_featured_image() {

    global $post;
    $thumb1link = get_post_meta($post->ID, 'thumb1link', $single = true);

    if (has_post_thumbnail()) {
      if(is_archive()) {
        the_post_thumbnail('archive-featured-image', array('class' => 'featured-image'));
      } else {
        the_post_thumbnail('single-post-featured-image', array('class' => 'featured-image'));
      }
    } elseif ($thumb1link) { ?>
      <img class="featured-image" src="<?php echo $thumb1link; ?>" />
    <?php } else {
      the_title('<div class="pseudo-image">', '</div>');
    }
  }


  //---------------------------------
  // Easy Peasy gallery
  //
  // Determines what images to put in the gallery.
  // Can only be used in the loop.
  //
  // Order of priority:
  // 1. Flickr set ID
  // 2. Custom fields (thumb[X] and thumb[X]link, where X = 1-12)
  // 3. WordPress gallery images
  //---------------------------------

  function epp_gallery() {

    global $post;
    $epp_options = get_option('epp_theme_options');
    $flickrapikey = $epp_options['flickrapikey'];
    $flickrsetid = get_post_meta($post->ID, 'flickrsetid', $single = true);
    $thumb1 = get_post_meta($post->ID, 'thumb1', $single = true);
    $thumb2 = get_post_meta($post->ID, 'thumb2', $single = true);
    $thumb1link = get_post_meta($post->ID, 'thumb1link', $single = true);
    $thumb2link = get_post_meta($post->ID, 'thumb2link', $single = true);
    $attachments = get_children(array(
      'post_type' => 'attachment',
      'numberposts' => -1,
      'post_status' => null,
      'post_parent' => $post->ID
    ));

    if ($flickrsetid && $flickrapikey) {
      include('functions-gallery-flickr.php');
    } elseif ($thumb1 && $thumb1link && $thumb2 && $thumb2link) {
      include('functions-gallery-customfields.php');
    } elseif ($attachments) {
      include('functions-gallery-attachments.php');
    }
  }


  //---------------------------------
  // Easy Peasy extrathings
  //
  // This is a highly random feature I've not yet decided
  // to publicly support. Basically, it collects
  // the data in the custom field "extrathings", and
  // applies WYSIWYG-styling to it. It's outputted in
  // the sidebar for now, but that might change at any time.
  // Please consider that if you decide to use it.
  //
  // This function also handles flattr and twitter integration.
  // The placement will almost certainly be the same in the
  // future, but I might switch them into different functions.
  //---------------------------------

  function epp_extrathings() {

    global $post;
    $extrathings = get_post_meta($post->ID, 'extrathings', $single = true);

    if (($extrathings) || function_exists('the_flattr_permalink') || function_exists('tweetbutton')) {
      if ($extrathings) { ?>
        <div class="section wysiwyg">
          <?php echo $extrathings; ?>
        </div>
      <?php }
      if (function_exists('the_flattr_permalink') || function_exists('tweetbutton')) { ?>
        <ul class="credit section">
          <?php if (function_exists('the_flattr_permalink')) { ?>
            <li><?php the_flattr_permalink(); ?></li>
          <?php }
          if (function_exists('tweetbutton')) { ?>
            <li><?php echo tweetbutton(null, true, 'vertical'); ?></li>
          <?php } ?>
        </ul>
      <?php } ?>
    <?php }
  }


  //---------------------------------
  // Easy Peasy subcats
  //
  // Displays links to sub categories
  // if we're on a category page that has
  // sub categories or a sub category page
  // with siblings. Takes one argument
  // which is used to add classes to the
  // containing ul.
  //
  // TODO: Can be written better.
  //---------------------------------

  function epp_subcats($classes) {

    global $cat;

    if (is_category()) {
      $this_category = get_category($cat);
      if ($this_category->category_parent) {
        $parent_cat_id = $this_category->category_parent;
      } elseif ($this_category) {
        $parent_cat_id = $this_category->cat_ID;
      }
      $args = array(
        'orderby' => 'name',
        'title_li' => '',
        'child_of' => $parent_cat_id,
        'echo' => '0'
      );
      $this_cat_id = $this_category->term_id;
      $categories = wp_list_categories($args);

      if ($categories !== ('<li>No categories</li>') || ('')) { ?>
        <ul class="cat-nav <?php echo $classes ?>">
          <li <?php if($parent_cat_id == $this_cat_id) { echo('class="current-cat"'); } ?>>
            <a href="<?php echo(get_category_link($parent_cat_id)); ?>">Everything</a>
          </li>
          <?php echo($categories); ?>
        </ul>
      <?php }
    }
  }


  //---------------------------------
  // Easy Peasy comments section
  //
  // Building awesome comment lists with awesome markup.
  // We got three functions here:
  // 1. epp_comment_list - this baby generates the comments
  // 2. epp_trackback_list - this bundle of joy generates pingbacks
  // 3. epp_commenter_link - displays an avatar image with hcard compliant photo class
  //---------------------------------

  function epp_comment_list($comment, $args, $depth) {
    $GLOBALS['comment'] = $comment;
    $GLOBALS['comment_depth'] = $depth; ?>

    <li id="comment-<?php comment_ID() ?>" <?php comment_class() ?>>
      <h3 class="comment-author vcard sub-header">
        <?php epp_commenter_link(); ?>
        <span class="comment-meta utility-info">
          <?php printf(__('<a href="%3$s" title="Permalink to this comment">%1$s</a>', 'epp'),
            get_comment_date(),
            get_comment_time(),
            '#comment-' . get_comment_ID()
          );

          // echo the comment reply link
          if($args['type'] == 'all' || get_comment_type() == 'comment') {
            comment_reply_link(array_merge($args, array(
              'reply_text' => __('reply','epp'),
              'login_text' => __('Log in to reply.','epp'),
              'depth' => $depth,
              'before' => ' ',
              'after' => ' '
            )));
          }

          edit_comment_link(__(' edit', 'epp')); ?>
        </span>
      </h3>

      <?php if ($comment->comment_approved == '0') {
        _e("<p class='unapproved sub-header'>Your comment is awaiting moderation.</p>", 'epp');
      } ?>

      <div class="comment-content wysiwyg">
        <?php comment_text() ?>
      </div>

  <?php }


  function epp_trackback_list($comment, $args, $depth) {
    $GLOBALS['comment'] = $comment; ?>

    <li id="comment-<?php comment_ID() ?>" <?php comment_class() ?>>
      <h3 class="comment-author sub-header">
        <?php printf(__('%1$s', 'epp'),
          get_comment_author_link(),
          get_comment_date(),
          get_comment_time());
        ?>
        <span class="comment-meta utility-info">
          <?php printf(__('<a href="%3$s" title="Permalink to this comment">%1$s</a>', 'epp'),
            get_comment_date(),
            get_comment_time(),
            '#comment-' . get_comment_ID()
          );
          edit_comment_link(__(' edit', 'epp')); ?>
        </span>
      </h3>

      <?php if ($comment->comment_approved == '0') {
        _e('<p class="unapproved sub-header">Your trackback is awaiting moderation.</p>', 'epp');
      } ?>

      <div class="comment-content wysiwyg">
        <?php comment_text() ?>
      </div>

  <?php }


  function epp_commenter_link() {
    $commenter = get_comment_author_link();
    if (ereg('<a[^>]* class=[^>]+>', $commenter)) {
      $commenter = ereg_replace('(<a[^>]* class=[\'"]?)', '\\1url ', $commenter);
    } else {
      $commenter = ereg_replace('(<a )/', '\\1class="url "', $commenter);
    }
    $avatar_email = get_comment_author_email();
    $avatar = str_replace("class='avatar", "class='photo avatar", get_avatar( $avatar_email, 50));
    echo $avatar . ' <span class="fn n">' . $commenter . '</span>';
  }