<?php
  /* Template Name: Front page with latest post collage */
  get_header();
  epp_front_collage();
?>

  <ul class="hfeed center">
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
      <li <?php post_class(); ?>>

        <div class="polaroid">
          <div class="image">
            <?php epp_featured_image(); ?>
          </div>
        </div>

        <div class="wysiwyg body">
          <?php if(is_singular()) { ?>
            <h1 class="header"><?php the_title(); ?></h1>
          <?php } else { ?>
            <h2 class="header"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
          <?php }
          the_content(); ?>
        </div>

      </li>
    <?php endwhile; else : endif; ?>
  </ul>

<?php get_footer(); ?>