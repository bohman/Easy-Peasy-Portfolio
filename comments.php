<?php // Run some checks for bots and password protected posts

$req = get_option('require_name_email'); // Checks if fields are required.

if ('comments.php' == basename($_SERVER['SCRIPT_FILENAME'])) {
  die ('Please do not load this page directly. Thanks!');
}

if (!empty($post->post_password)) {
  if ($_COOKIE['wp-postpass_' . COOKIEHASH] != $post->post_password) { ?>

    <p class="nopassword sub-header">
      <?php _e('This post is password protected. Enter the password to view any comments.', 'epp') ?>
    </p>

    <?php return;
  }
} 


if (have_comments() || ('open' == $post->comment_status)) { ?>
  <h2 class="header">Discussion</h2>
  <div id="response-lists" class="body">
    <?php // Displaying comments
    if (have_comments()) {
      // Count the number of comments and trackbacks
      $ping_count = $comment_count = 0;
      foreach ($comments as $comment ) {
        get_comment_type() == "comment" ? ++$comment_count : ++$ping_count;
      }

      // If there are comments, show them!
      if (!empty($comments_by_type['comment'])) { ?>
        <div id="comments-list">
          <ol>
            <?php wp_list_comments('type=comment&callback=epp_comment_list'); ?>
          </ol>

          <?php // Comment navigation below, if needed
          $total_pages = get_comment_pages_count();
          if ($total_pages > 1) { ?>
            <p id="comments-nav-below" class="comments-navigation">
              <?php paginate_comments_links(); ?>
            </p>
          <?php } ?>
        </div>
      <?php } ?>

      <?php // If there are trackbacks(pings), show the trackbacks
      if (!empty($comments_by_type['pings'])) { ?>
        <div id="trackbacks-list">
          <ol>
            <?php wp_list_comments('type=pings&callback=epp_trackback_list'); ?>
          </ol>
        </div>
      <?php } ?>
    <?php } elseif ('open' == $post->comment_status) { ?>
      <h3 class="sub-header">No comments yet. Make a mark and be the first!</h3>
    <?php } ?>

  </div>
<?php } ?>

<?php // Comment form
if ('open' == $post->comment_status) { ?>
  <div id="respond" class="aside">
    <h3 class="sub-header"><?php comment_form_title( __('Post a comment', 'epp'), __('Reply to %s', 'epp') ); ?>
      <span class="utility-info"><?php cancel_comment_reply_link('cancel'); ?></span>
    </h3>

    <?php // If you have to be logged in to post a comment and isn't logged in
    if (get_option('comment_registration') && !$user_ID) { ?>
      <p id="login-req">
        <?php printf(__('Please <a href="%s" title="Log in">log in</a> to post a comment. Thanks!', 'epp'),
      get_option('siteurl') . '/wp-login.php?redirect_to=' . get_permalink()); ?>
      </p>

    <?php // If you're allowed to see the comment form
    } else { ?>
      <form id="commentform" action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post">

        <?php // If you're logged in
        if ($user_ID) { ?>
          <p id="loggedin" class="sub-header">
            <?php printf(__('Posting as <a href="%1$s" title="Logged in as %2$s">%2$s</a> <a class="logout utility-info" href="%3$s" title="Log out of this account">log out</a>
            ', 'epp'), get_option('siteurl') . '/wp-admin/profile.php', wp_specialchars($user_identity, true), wp_logout_url(get_permalink())); ?>
          </p>

        <?php // If you're a regular user
        } else { ?>
          <div id="form-section-author" class="form-section">
            <label for="author" class="utility-info"><?php _e('Name', 'epp') ?><?php if ($req) _e(' (pretty please)', 'epp') ?></label>
            <input id="author" name="author" type="text" value="<?php echo $comment_author ?>" maxlength="50" tabindex="3" />
          </div>

          <div id="form-section-email" class="form-section">
            <label for="email" class="utility-info"><?php _e('Email', 'epp') ?><?php if ($req) _e(' (pretty please)', 'epp') ?></label>
            <input id="email" name="email" type="text" value="<?php echo $comment_author_email ?>" tabindex="4" />
          </div>

          <div id="form-section-url" class="form-section">
            <label for="url" class="utility-info"><?php _e('Website', 'epp') ?></label>
            <input id="url" name="url" type="text" value="<?php echo $comment_author_url ?>" tabindex="5" />
          </div>
        <?php } ?>

        <div id="form-section-comment" class="form-section">
          <label for="comment" class="utility-info"><?php _e('Your awesome comment', 'epp') ?></label>
          <textarea id="comment" name="comment" tabindex="6"></textarea>
        </div>

        <?php do_action('comment_form', $post->ID); ?>
        <div class="form-submit form-section">
          <input id="submit" name="submit" type="submit" value="<?php _e('Post the comment', 'epp') ?>" tabindex="7" />
          <input type="hidden" name="comment_post_ID" value="<?php echo $id; ?>" />
        </div>

        <?php comment_id_fields(); ?>
      </form>
    <?php } ?>
  </div>
<?php } ?>