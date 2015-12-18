<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the page-wrap dive and the footer itself
 *
 */
?>
    </div>

    <footer>
      <div class="block">
        <div class="full">
          <?php dynamic_sidebar( 'Footer' ); ?>
          <span>&copy; <?php echo date( "Y" ); echo " "; bloginfo( 'name' ); ?></span>
        </div>
      </div>
    </footer>
    <?php wp_footer(); ?>
  </body>
</html>
