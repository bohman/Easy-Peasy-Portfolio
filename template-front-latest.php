<?php
  /* Template Name: Front page with 6 latest entries */
  get_header();
?>


<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
  <div id="presentation" class="center">

    <div class="polaroid">
      <div class="image">
        <?php epp_featured_image(); ?>
      </div>
    </div>

    <h2 class="header"><?php the_title(); ?></h2>

    <div class="wysiwyg">
      <?php the_content(); ?>
    </div>

  </div>
<?php endwhile; else : endif; ?>


<h2 class="header center"><?php _e('Latest entries', 'epp'); ?></h2>
<ul class="hfeed center">
  <?php epp_latest_entries(); ?>
</ul>


<?php get_footer(); ?>