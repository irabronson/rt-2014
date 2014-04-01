<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package CleanSlate
 * @since CleanSlate 0.1
 */
?>

<?php get_header(); ?>

<?php
    while ( have_posts() ) : the_post();
        
        if( is_page('home') || is_home() ) :
            // get_template_part( 'content', 'home' );
            
        elseif( is_page('about-ym') ) :
            get_template_part( 'content', 'about' );
            
        elseif( is_page('contact') ) :
            get_template_part( 'content', 'contact' );
            
        else :
            get_template_part( 'content', 'page' );
        endif;
        
    endwhile; // end of the loop.
?>

<?php get_footer(); ?>