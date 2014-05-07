<?php
/**
 * The Template for displaying all single posts.
 *
 * @package RazorAndTie
 * @since RazorAndTie 0.1
 */
?>

<?php get_header(); ?>

<?php
    if ( have_posts() ) :
        
        while ( have_posts() ) : the_post();
            
            // Non-protected posts
            if ( ! post_password_required($post) ) :
                // Code to fetch and print CFs, such as:
                
                if( get_post_type($post->ID) === 'artist' ) :
                    get_template_part('content', 'artist-detail' );
                    
                else :
                    get_template_part('content', 'single' );
                    
                endif;
            else :
                get_template_part('content', 'password-form');
            endif;
        endwhile;
    else :
        // Content Not Found Template
        include('content-not-found.php');
        
    endif;
?>

<?php get_footer(); ?>