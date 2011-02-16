<?php
// TODO: Make the 404 template more useful. And pretty. We like prettiness.
get_header(); ?>

  <ul class="posts center">
      <li <?php post_class('wysiwyg'); ?>>
        <h2>Oh. My. God!</h2>
        <p>Something went wrong, so you get to see this error page! It's not particularly useful at the moment, but I promise to remedy that in future updates of this theme. It is, after all, only an alpha version.</p>
      </li>
  </ul>

<?php get_footer(); ?>