<?php

  //---------------------------------
  // Acting on our options
  //
  // Here we make sure that our options actually do stuff.
  //---------------------------------
  $epp_options = get_option('epp_theme_options');


  //---------------------------------
  // Easy Peasy mode
  //
  // Easy Peasy mode activates a stylesheet and javascript
  // that hides parts of the admin area that are considered
  // a hindrance for optimal workflow. These includes seldom
  // used items like post revisions and custom fields.
  //---------------------------------
  if($epp_options['easypeasymode'] == 'yes') {
    add_action('admin_print_styles', 'epp_easy_peasy_mode_css');
    add_action('admin_print_scripts', 'epp_easy_peasy_mode_js');
  }

  function epp_easy_peasy_mode_css() {
    wp_enqueue_style('epp_admin_css', get_bloginfo('template_directory') . '/admin/admin-styles.css');
  }

  function epp_easy_peasy_mode_js() {
    wp_enqueue_script('epp_admin', get_bloginfo("template_directory") . '/admin/admin-js.js', array('jquery'));
  }


  //---------------------------------
  // Adding extra fields to post screen
  //
  // Easy Peasy Portfolio can make it easy for you to add 
  // images from a flickr set, or to customize the gallery
  // with Custom Fields. However, we only want to show these
  // options to people who want them, and thus we make each
  // of them an option.
  //---------------------------------
  if($epp_options['imagelinks'] == 'yes') {
    add_action('admin_init', 'epp_add_imagelinks');
    add_action('save_post', 'save_imagelinks');
  }

  if($epp_options['flickrapikey']) {
    add_action('admin_init', 'epp_add_flickrsetid');
    add_action('save_post', 'save_flickr');
  }

  function epp_add_imagelinks() {
    add_meta_box('imagelinks', 'Image links', 'imagelinks', 'post', 'normal', 'high');
  }

  function epp_add_flickrsetid() {
    add_meta_box('flickrsetid', 'Flickr Set ID', 'flickrsetid', 'post', 'normal', 'high');
  }

  function imagelinks() {
    global $post;
    $custom = get_post_custom($post->ID);
    $thumb1 = $custom['thumb1'][0];
    $thumb2 = $custom['thumb2'][0];
    $thumb3 = $custom['thumb3'][0];
    $thumb4 = $custom['thumb4'][0];
    $thumb5 = $custom['thumb5'][0];
    $thumb6 = $custom['thumb6'][0];
    $thumb7 = $custom['thumb7'][0];
    $thumb8 = $custom['thumb8'][0];
    $thumb9 = $custom['thumb9'][0];
    $thumb10 = $custom['thumb10'][0];
    $thumb11 = $custom['thumb11'][0];
    $thumb12 = $custom['thumb12'][0];
    $thumb1link = $custom['thumb1link'][0];
    $thumb2link = $custom['thumb2link'][0];
    $thumb3link = $custom['thumb3link'][0];
    $thumb4link = $custom['thumb4link'][0];
    $thumb5link = $custom['thumb5link'][0];
    $thumb6link = $custom['thumb6link'][0];
    $thumb7link = $custom['thumb7link'][0];
    $thumb8link = $custom['thumb8link'][0];
    $thumb9link = $custom['thumb9link'][0];
    $thumb10link = $custom['thumb10link'][0];
    $thumb11link = $custom['thumb11link'][0];
    $thumb12link = $custom['thumb12link'][0];
    ?>
    <p class="description">If you want to customize the gallery of this portfolio entry with external images, you can do so below. Thumbnails must be 75x75 pixels, or they will be clipped. Large images must be between 800x700 pixels, or they will be resized. Remember that you must link to actual images (files that end in .jpg, .gif or .png) and not folders.</p>
    <p class="description">If you don't want this fine-grained control it's better to embed a flickr set ID or use the WordPress gallery.</p>
    <p><label><strong>Image 1:</strong> thumbnail</label>
    <input type="text" name="thumb1" value="<?php echo $thumb1; ?>" /></p>
    <p><label><strong>Image 1:</strong> large image</label>
    <input type="text" name="thumb1link" value="<?php echo $thumb1link; ?>" /></p>
    <p><label><strong>Image 2:</strong> thumbnail</label>
    <input type="text" name="thumb2" value="<?php echo $thumb2; ?>" /></p>
    <p><label><strong>Image 2:</strong> large image</label>
    <input type="text" name="thumb2link" value="<?php echo $thumb2link; ?>" /></p>
    <p><label><strong>Image 3:</strong> thumbnail</label>
    <input type="text" name="thumb3" value="<?php echo $thumb3; ?>" /></p>
    <p><label><strong>Image 3:</strong> large image</label>
    <input type="text" name="thumb3link" value="<?php echo $thumb3link; ?>" /></p>
    <p><label><strong>Image 4:</strong> thumbnail</label>
    <input type="text" name="thumb4" value="<?php echo $thumb4; ?>" /></p>
    <p><label><strong>Image 4:</strong> large image</label>
    <input type="text" name="thumb4link" value="<?php echo $thumb4link; ?>" /></p>
    <p><label><strong>Image 5:</strong> thumbnail</label>
    <input type="text" name="thumb5" value="<?php echo $thumb5; ?>" /></p>
    <p><label><strong>Image 5:</strong> large image</label>
    <input type="text" name="thumb5link" value="<?php echo $thumb5link; ?>" /></p>
    <p><label><strong>Image 6:</strong> thumbnail</label>
    <input type="text" name="thumb6" value="<?php echo $thumb6; ?>" /></p>
    <p><label><strong>Image 6:</strong> large image</label>
    <input type="text" name="thumb6link" value="<?php echo $thumb6link; ?>" /></p>
    <p><label><strong>Image 7:</strong> thumbnail</label>
    <input type="text" name="thumb7" value="<?php echo $thumb7; ?>" /></p>
    <p><label><strong>Image 7:</strong> large image</label>
    <input type="text" name="thumb7link" value="<?php echo $thumb7link; ?>" /></p>
    <p><label><strong>Image 8:</strong> thumbnail</label>
    <input type="text" name="thumb8" value="<?php echo $thumb8; ?>" /></p>
    <p><label><strong>Image 8:</strong> large image</label>
    <input type="text" name="thumb8link" value="<?php echo $thumb8link; ?>" /></p>
    <p><label><strong>Image 9:</strong> thumbnail</label>
    <input type="text" name="thumb9" value="<?php echo $thumb9; ?>" /></p>
    <p><label><strong>Image 9:</strong> large image</label>
    <input type="text" name="thumb9link" value="<?php echo $thumb9link; ?>" /></p>
    <p><label><strong>Image 10:</strong> thumbnail</label>
    <input type="text" name="thumb10" value="<?php echo $thumb10; ?>" /></p>
    <p><label><strong>Image 10:</strong> large image</label>
    <input type="text" name="thumb10link" value="<?php echo $thumb10link; ?>" /></p>
    <p><label><strong>Image 11:</strong> thumbnail</label>
    <input type="text" name="thumb11" value="<?php echo $thumb11; ?>" /></p>
    <p><label><strong>Image 11:</strong> large image</label>
    <input type="text" name="thumb11link" value="<?php echo $thumb11link; ?>" /></p>
    <p><label><strong>Image 12:</strong> thumbnail</label>
    <input type="text" name="thumb12" value="<?php echo $thumb12; ?>" /></p>
    <p><label><strong>Image 12:</strong> large image</label>
    <input type="text" name="thumb12link" value="<?php echo $thumb12link; ?>" /></p>
    <?php
  }

  function flickrsetid() {
    global $post;
    $custom = get_post_custom($post->ID);
    $flickrsetid = $custom['flickrsetid'][0];
    ?>
    <p class="description">To embed a Flickr Set just paste the set ID below. Easy Peasy Portfolio will automatically get the first image of the set and feature it as the main image, unless you overwrite this by setting a featured image yourself. Here's how to find a Flickr Set ID.</p>
    <p><label>Flickr Set ID:</label>
    <input type="text" name="flickrsetid" value="<?php echo $flickrsetid; ?>" /></p>
    <?php
  }

  function save_flickr() {
    global $post;
    update_post_meta($post->ID, 'flickrsetid', $_POST['flickrsetid']);
  }

  function save_imagelinks() {
    global $post;
    update_post_meta($post->ID, 'thumb1', $_POST['thumb1']);
    update_post_meta($post->ID, 'thumb2', $_POST['thumb2']);
    update_post_meta($post->ID, 'thumb3', $_POST['thumb3']);
    update_post_meta($post->ID, 'thumb4', $_POST['thumb4']);
    update_post_meta($post->ID, 'thumb5', $_POST['thumb5']);
    update_post_meta($post->ID, 'thumb6', $_POST['thumb6']);
    update_post_meta($post->ID, 'thumb7', $_POST['thumb7']);
    update_post_meta($post->ID, 'thumb8', $_POST['thumb8']);
    update_post_meta($post->ID, 'thumb9', $_POST['thumb9']);
    update_post_meta($post->ID, 'thumb10', $_POST['thumb10']);
    update_post_meta($post->ID, 'thumb11', $_POST['thumb11']);
    update_post_meta($post->ID, 'thumb12', $_POST['thumb12']);
    update_post_meta($post->ID, 'thumb1link', $_POST['thumb1link']);
    update_post_meta($post->ID, 'thumb2link', $_POST['thumb2link']);
    update_post_meta($post->ID, 'thumb3link', $_POST['thumb3link']);
    update_post_meta($post->ID, 'thumb4link', $_POST['thumb4link']);
    update_post_meta($post->ID, 'thumb5link', $_POST['thumb5link']);
    update_post_meta($post->ID, 'thumb6link', $_POST['thumb6link']);
    update_post_meta($post->ID, 'thumb7link', $_POST['thumb7link']);
    update_post_meta($post->ID, 'thumb8link', $_POST['thumb8link']);
    update_post_meta($post->ID, 'thumb9link', $_POST['thumb9link']);
    update_post_meta($post->ID, 'thumb10link', $_POST['thumb10link']);
    update_post_meta($post->ID, 'thumb11link', $_POST['thumb11link']);
    update_post_meta($post->ID, 'thumb12link', $_POST['thumb12link']);
  }