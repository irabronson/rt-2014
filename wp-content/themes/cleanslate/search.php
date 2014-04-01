<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package CleanSlate
 * @since CleanSlate 0.1
 */
?>

<?php get_header(); ?>

<?php include('content-filters.php'); ?>

<?php
    
    if ( have_posts() ) :
        
        get_template_part('content-browse', get_post_format() );
        
    else :
        // Content Not Found Template
        include('content-no-results.php');
        
    endif;
?>

<?php get_footer(); ?>
