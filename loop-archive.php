<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
  <li <?php post_class('archive'); ?>>

    <div class="polaroid">
      <a class="image" href="<?php the_permalink(); ?>" title="Have a closer look at <?php the_title();?>">
        <?php epp_featured_image(); ?>
      </a>
      <h2 class="caption">
        <a href="<?php the_permalink(); ?>" title="Have a closer look at <?php the_title();?>"><?php the_title(); ?></a>
      </h2>
    </div>

  </li>
<?php endwhile; endif; ?>