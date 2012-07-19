<?php get_header();

if (is_archive()) {
  query_posts($query_string . '&posts_per_page=-1'); // TODO: Do as filter instead?
} ?>

<h1 class="header center"><?php single_cat_title(); ?></h1>
<?php epp_subcats('center'); ?>

<ul class="hfeed center">
  <?php get_template_part('loop', 'archive'); ?>
</ul>

<?php get_footer(); ?>