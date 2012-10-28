<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
  <li <?php post_class('archive'); ?>>

    <div class="polaroid">
      <a class="image" href="<?php the_permalink(); ?>" title="Have a closer look at <?php the_title(); ?>">
        <?php epp_featured_image(); ?>
      </a>
      <a href="<?php the_permalink(); ?>" title="Have a closer look at <?php the_title(); ?>" class="caption">
        <div class="archive-details">
          <h2 class="title"><?php the_title(); ?></h2>
          <p class="post-date"><?php the_time('Y-m-d'); ?></p>
          <p class="category-names"><?php epp_archive_cats(); ?></p>
        </div>
      </a>
    </div>

  </li>
<?php endwhile; endif; ?>