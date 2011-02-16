<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
  <li <?php post_class(); ?>>

    <div class="polaroid">
      <div class="image">
        <?php epp_featured_image(); ?>
      </div>
    </div>

    <div class="wysiwyg body">
      <?php if(is_singular()) { ?>
        <h1 class="header"><?php the_title(); ?><?php edit_post_link('edit', ' ', '')?></h1>
      <?php } else { ?>
        <h2 class="header"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a><?php edit_post_link('edit', ' ', '')?></h2>
      <?php } ?>
      <?php the_content(); ?>
    </div>

    <div class="aside">
      <?php
        epp_gallery();
        epp_extrathings();
      ?>
    </div>

    <div class="comments">
      <?php comments_template('', true); ?>
    </div>

  </li>
<?php endwhile; else : endif; ?>