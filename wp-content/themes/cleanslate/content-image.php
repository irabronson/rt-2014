<?php
/**
 * The template for displaying posts in image format.
 *
 * @package RazorAndTie
 * @since RazorAndTie 0.1
 */
?>

<h2 class="page-title">
    <?php
        the_title();
    ?>
</h2>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <div id="text" class="text-container">
        <?php the_content(); ?>
    </div>

</article><!-- #post-<?php the_ID(); ?> -->
