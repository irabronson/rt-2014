<?php
/**
 * The Template for displaying all single posts.
 *
 * @package CleanSlate
 * @since CleanSlate 0.1
 */
?>

<?php get_header(); ?>

<?php
    if ( have_posts() ) :
        
        while ( have_posts() ) : the_post();
            
            if( get_post_type($post->ID) === 'artist' ) :
                get_template_part('content', 'artist-detail' );
                
            else :
                get_template_part('content', 'single' );
                
            endif;
            
        endwhile;
        
    else :
        // Content Not Found Template
        include('content-not-found.php');
        
    endif;
?>

<?php get_footer(); ?>