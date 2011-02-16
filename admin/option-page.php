<?php

  //---------------------------------
  // Options page
  //
  // Sets up the Easy Peasy options page. It's basically
  // a form that sets values. We can call these values with
  // get_option('option-name');
  //
  // The cleverer parts are based on the awesome option page
  // made by the guys at themeshaper:
  // http://themeshaper.com/sample-theme-options/
  //---------------------------------

  add_action('admin_init', 'epp_init');
  add_action('admin_menu', 'epp_add_page');


  // Init plugin options to white list our options
  function epp_init() {
    register_setting('epp_options', 'epp_theme_options', 'epp_validate');
  }


  // Load up the menu page
  function epp_add_page() {
    add_theme_page(__('Easy Peasy Options'), __('Easy Peasy Options'), 8, 'easy_peasy_options', 'epp_do_page');
  }


  // Create arrays with our options
  $easy_peasy_mode = array(
    'yes' => array(
      'value' => 'yes',
      'label' => __('Yes, I want to activate Easy Peasy mode and just <em>work</em>')
    ),
    'no' => array(
      'value' => 'no',
      'label' => __('No, I want the regular admin panel with all of its settings')
    )
  );

  $meta_custom_images = array(
    'yes' => array(
      'value' => 'yes',
      'label' => __('Yes, I\'d like to use images from external URLs')
    ),
    'no' => array(
      'value' => 'no',
      'label' => __('No, I work <em>smarter</em>, not <em>harder</em> and prefer to use flickr and WordPress\' built in functions')
    )
  );


  // Create the options page
  function epp_do_page() {
    global $easy_peasy_mode, $meta_flickr_set_id, $meta_custom_images;

    $theme_data = get_theme_data(get_bloginfo(stylesheet_url));

    if (!isset($_REQUEST['updated']))
    $_REQUEST['updated'] = false; ?>

    <div class="wrap">
      <?php screen_icon(); echo "<h2>" . get_current_theme() . __(' options') . "</h2>"; ?>

      <p>By <?php echo($theme_data[Author]); ?>, the LEGO-maniac of <a href="http://swooshable.com">Swooshable</a>.</p>

      <?php if (false !== $_REQUEST['updated']) : ?>
        <div class="updated fade"><p><strong><?php _e('Options saved'); ?></strong></p></div>
      <?php endif; ?>

      <form method="post" action="options.php">
        <?php settings_fields('epp_options');
        $options = get_option('epp_theme_options'); ?>

        <table class="form-table">
          <tr valign="top">

            <th scope="row">
              <strong><?php _e('Easy Peasy mode'); ?></strong>
            </th>

            <td>
              <fieldset>
                <legend class="screen-reader-text">
                  <span><?php _e('Easy Peasy mode'); ?></span>
                </legend>

                <p style="color: #666666;">The Easy Peasy mode attempts to streamline your workflow. It hides a bunch of options that you shouldn't use daily (such as one-time settings) and adds useful shortcuts here and there. It's usually a great thing to keep activated when you do your day-to-day work on the portfolio. If you're an advanced user or need to do something more out of the ordinary you should disable it. Don't worry: no data is lost. Just deactivate this mode if you want the regular admin panel back.</p>

                <?php if (!isset($checked)) $checked = '';
                  foreach ($easy_peasy_mode as $option) {

                    $radio_setting = $options['easypeasymode'];

                    // Determine if this option is selected or not
                    if ('' != $radio_setting) {
                      if ($options['easypeasymode'] == $option['value']) {
                        $checked = "checked=\"checked\"";
                      } else {
                        $checked = '';
                      }
                    }
                    // Iterate and display all radio options ?>
                    <label class="description">
                      <input type="radio" name="epp_theme_options[easypeasymode]" value="<?php esc_attr_e($option['value']); ?>" <?php echo $checked; ?> /> <?php echo $option['label']; ?>
                    </label><br />

                <?php } ?>
              </fieldset>
              <br />
            </td>
          </tr>
          <tr valign="top">

            <th scope="row">
              <strong><?php _e('Gallery images'); ?></strong>
            </th>

            <td>
              <fieldset>
                <legend class="screen-reader-text">
                  <span><?php _e('Gallery images'); ?></span>
                </legend>

                <h3 style="padding-top:0px;margin-top: 0px">Embed Flickr sets</h3>
                <p style="color: #666666;">You can easily embed flickr sets with Easy Peasy Portfolio. Enter your <a href="http://www.flickr.com/services/api/misc.api_keys.html">flickr API key</a> below and you'll find a new flickr box when you write or edit posts. Paste the flickr set ID in that box, and magic will happen.</p>

                <label class="description" for="epp_theme_options[flickrapikey]">
                  <?php _e('Flickr API Key:'); ?>
                </label>
                <input
                  id="epp_theme_options[flickrapikey]"
                  class="regular-text"
                  type="text"
                  name="epp_theme_options[flickrapikey]"
                  value="<?php esc_attr_e($options['flickrapikey']); ?>"
                />
                <br /><br />

                <h3>Manually entering URLs</h3>
                <p style="color: #666666;">You may also enter the URL for each gallery image manually. This is useful when you host images elsewhere and want to deliver them from there. If you choose this option you'll have to enter two URLs for each image: one for the thumbnail and one for the large image. The thumbnail must be 75x75 pixels, or it will be clipped to that size. The large image must be 800x700 pixels, or it will be resized to fit.</p>

                <?php if (!isset($checked)) $checked = '';
                  foreach ($meta_custom_images as $option) {

                    $radio_setting = $options['imagelinks'];

                    // Determine if this option is selected or not
                    if ('' != $radio_setting) {
                      if ($options['imagelinks'] == $option['value']) {
                        $checked = "checked=\"checked\"";
                      } else {
                        $checked = '';
                      }
                    }
                    // Iterate and display all radio options ?>
                    <label class="description">
                      <input type="radio" name="epp_theme_options[imagelinks]" value="<?php esc_attr_e($option['value']); ?>" <?php echo $checked; ?> /> <?php echo $option['label']; ?>
                    </label><br />

                <?php } ?>

              </fieldset>
            </td>
          </tr>
          <tr valign="top">

             <th scope="row">
               <strong><?php _e('Front Page'); ?></strong>
             </th>

             <td>
               <fieldset>
                 <legend class="screen-reader-text">
                   <span><?php _e('Front Page'); ?></span>
                 </legend>

                 <p style="color: #666666;">here's the front description</p>

                 <label class="description" for="epp_theme_options[frontheadline]">
                   <?php _e('Headline:'); ?>
                 </label>
                 <input
                   id="epp_theme_options[frontheadline]"
                   class="regular-text"
                   type="text"
                   name="epp_theme_options[frontheadline]"
                   value="<?php esc_attr_e($options['frontheadline']); ?>"
                 /><br/>

                 <label class="description" for="epp_theme_options[frontpresentation]">
                   <?php _e('Presentation:'); ?>
                 </label>
                 <input
                   id="epp_theme_options[frontpresentation]"
                   class="regular-text"
                   type="text"
                   name="epp_theme_options[frontpresentation]"
                   value="<?php esc_attr_e($options['frontpresentation']); ?>"
                 /><br/>

                 <label class="description" for="epp_theme_options[frontlinkurl]">
                   <?php _e('Link URL:'); ?>
                 </label>
                 <input
                   id="epp_theme_options[frontlinkurl]"
                   class="regular-text"
                   type="text"
                   name="epp_theme_options[frontlinkurl]"
                   value="<?php esc_attr_e($options['frontlinkurl']); ?>"
                 /><br/>

                 <label class="description" for="epp_theme_options[frontlinktext]">
                   <?php _e('Link text:'); ?>
                 </label>
                 <input
                   id="epp_theme_options[frontlinktext]"
                   class="regular-text"
                   type="text"
                   name="epp_theme_options[frontlinktext]"
                   value="<?php esc_attr_e($options['frontlinktext']); ?>"
                 /><br/>

                 <label class="description" for="epp_theme_options[frontimageurl]">
                   <?php _e('Image URL:'); ?>
                 </label>
                 <input
                   id="epp_theme_options[frontimageurl]"
                   class="regular-text"
                   type="text"
                   name="epp_theme_options[frontimageurl]"
                   value="<?php esc_attr_e($options['frontimageurl']); ?>"
                 />

               </fieldset>
               <br />
             </td>
           </tr>
        </table>

        <p class="submit">
          <input type="submit" class="button-primary" value="<?php _e('Save Options'); ?>" />
        </p>
      </form>
    </div>
    <?php
  }


  // Sanitize and validate input. Accepts an array, return a sanitized array.
  function epp_validate($input) {
    global $easy_peasy_mode, $meta_flickr_set_id, $meta_custom_images;

    // Easy Peasy mode option must actually be in Easy Peasy mode array
    if (!isset($input['easypeasymode']))
      $input['easypeasymode'] = null;
    if (!array_key_exists($input['easypeasymode'], $easy_peasy_mode))
      $input['easypeasymode'] = null;

    // Flickr API key must be safe text with no HTML tags
    $input['flickrapikey'] = wp_filter_nohtml_kses( $input['flickrapikey'] );

    // Custom images option must actually be in Flickr Set ID array
    if (!isset($input['imagelinks']))
      $input['imagelinks'] = null;
    if (!array_key_exists($input['imagelinks'], $meta_custom_images))
      $input['imagelinks'] = null;

    return $input;
  }