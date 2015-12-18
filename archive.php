<?php
/**
 * The template for displaying archive pages
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 *
 */

get_header(); ?>

  <section class="main archive-content" role="main">

    <?php if ( have_posts() ) : ?>

      <?php the_archive_title( '<h1>', '</h1>' );
      the_archive_description( '<div class="archive-tax-description">', '</div>' ); ?>

      <?php while ( have_posts() ) : the_post(); ?>

        <article <?php post_class() ?>>
          <header>
            <h1><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h1>
            <?php get_template_part( 'templates/entry-meta' ); ?>
          </header>

          <div class="entry">
            <?php the_content(); ?>
          </div>

        </article>

      <?php endwhile; ?>

      <?php the_posts_pagination(); ?>

  <?php else : ?>

    <h1>Nothing found</h1>

  <?php endif; ?>

  </section>

<?php get_sidebar(); ?>
<?php get_footer(); ?>