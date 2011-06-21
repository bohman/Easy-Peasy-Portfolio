<div id="footer" class="center">
  <ul id="footer-left" class="column">
    <?php if(is_active_sidebar('left-footer')) {
      dynamic_sidebar('Left footer');
    } else {
      echo('<li>&nbsp;</li>');
    } ?>
  </ul>
  <ul id="footer-middle" class="column">
    <?php if(is_active_sidebar('middle-footer')) {
      dynamic_sidebar('Middle footer');
    } else {
      echo('<li>&nbsp;</li>');
    } ?>
  </ul>
  <ul id="footer-right" class="column">
    <?php if(is_active_sidebar('right-footer')) {
      dynamic_sidebar('Right footer');
    } else {
      echo('<li>&nbsp;</li>');
    } ?>
  </ul>
</div>
<?php wp_footer(); ?></body></html>