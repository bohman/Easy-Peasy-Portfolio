<?php
// TODO: This is a messy template. Consider it a temporary fix and rework it.
get_header();
$epp_options = get_option('epp_theme_options'); ?>


  <div id="presentation" class="center">
    <?php if ($epp_options['frontimageurl']) { ?>
      <div class="polaroid">
        <div class="image">
          <img src="<?php echo $epp_options['frontimageurl']; ?>" alt="Linus Bohman" />
        </div>
      </div>
    <?php } ?>

    <?php if ($epp_options['frontheadline']) { ?>
      <h2 class="header"><?php echo $epp_options['frontheadline']; ?></h2>
    <?php }

    if ($epp_options['frontpresentation']) { ?>
      <div class="wysiwyg">
        <p><?php echo $epp_options['frontpresentation']; ?></p>

        <?php if ($epp_options['frontlinkurl']) { ?>
          <p class="push-link">
            <a href="<?php echo $epp_options['frontlinkurl']; ?>" class="action-link">
              <?php if ($epp_options['frontlinktext']) { 
                echo $epp_options['frontlinktext'];
              } else {
                echo ('Read more');
              } ?>
            </a>
          </p>
        <?php } ?>
      </div>
    <?php } ?>
  </div>


  <div class="slideshow">
    <ul class="center">
      <?php
        query_posts($query_string . '&posts_per_page=6');
        get_template_part('loop', 'archive');
      ?>
    </ul>
  </div>


<?php get_footer(); ?>