<?php
/**
 * The template for category pages.
 *
 * @package RazorAndTie
 * @since RazorAndTie 0.1
 */
?>

<?php get_header(); ?>

<section id="primary">
    
    <div class="title">
        <div class="wrapper">
            <h2><?php wp_title(''); ?></h2>
        </div>
    </div>
    
</section>

<section id="secondary">
    <?php
        if( is_category('projects') ) {
            include('content-filters.php');
        }
    ?>
    
<?php
if ( have_posts() ) :
?>
    
    <div id="articles">
    
    <?php
        while ( have_posts() ) : the_post();
            get_template_part('content-thumb', get_post_format() );
        endwhile;
    ?>
    
    </div>
    
<?php
else :
    
    // Content Not Found Template
    include('content-not-found.php');
    
endif;
?>
</section>

<div id="pagination">
    <div id="next-page"><?php next_posts_link('Next &rarr;','') ?></div>
</div>

<?php get_footer(); ?>