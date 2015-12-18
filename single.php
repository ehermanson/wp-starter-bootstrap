<?php
/**
 * The template for displaying all single posts and attachments
 *
 */

get_header(); ?>

  <section class="main" role="main">

    <?php

    while ( have_posts() ) : the_post();

      get_template_part( 'templates/content-single' );

      // If comments are open or there is at least one comment, get the comment template
      if ( comments_open() || get_comments_number() ) {
        comments_template();
      }

    endwhile;
    ?>

  </section>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
