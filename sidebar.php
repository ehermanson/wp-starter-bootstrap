<?php
/**
 * The template for the sidebar containing the main widget area
 *
 */
?>

<?php if ( is_active_sidebar( 'main-sidebar' )  ) : ?>

  <aside class="sidebar">
    <?php dynamic_sidebar( 'Main Sidebar' ); ?>
  </aside>

<?php endif; ?>