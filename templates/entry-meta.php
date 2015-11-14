<?php
/**
 * The template used for displaying post meta information
 */
?>

<div class="post-meta">
  <time class="post-meta-published" datetime="<?php echo get_the_time('c'); ?>"><?php the_time('F jS, Y') ?></time>
  <span class="post-meta-category">| Posted in <?php the_category(', ') ?> |</span>
  <span class="post-meta-comments"><i class="fa fa-comments"></i> <?php comments_popup_link( 'No comments yet', '1 comment', '% comments', 'comments-link', '' ); ?>
</div>