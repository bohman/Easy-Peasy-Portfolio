<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
  <li <?php post_class('archive'); ?>>

    <div class="polaroid">
      <a class="image" href="<?php the_permalink(); ?>" title="Have a closer look at <?php the_title();?>">
        <?php epp_featured_image(); ?>
      </a>
      <?php if(is_home()) { ?>
        <h3 class="caption">
      <?php } else { ?>
        <h2 class="caption">
      <?php } ?>
        <a href="<?php the_permalink(); ?>" title="Have a closer look at <?php the_title();?>"><?php the_title(); ?></a>
      <?php if(is_home()) { ?>
        </h3>
      <?php } else { ?>
        </h2>
      <?php } ?>
    </div>

  </li>
<?php endwhile; endif; ?>