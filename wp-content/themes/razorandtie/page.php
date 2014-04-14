<?php
/**
 *  Template:
 *  Determines which page sub-template to display.
 *  For displaying all pages.
 *
 * @package RazorAndTie
 * @since RazorAndTie 0.1
 */
?>

<?php get_header(); ?>

<!-- Page Template -->
<?php
    if( is_page('artists') ) :
        
        // Set arguments
        $args = array(
            'post_type' => 'artist',
            'orderby' => 'meta_value',
            'meta_key' => 'artist_list_display_name',
            'order' =>  'ASC',
            'posts_per_page' => -1
        );
        
        // Query Artist Post Type
        $artist_query = new WP_Query( $args );
        include('content-artists.php');
        
    elseif( is_page('upcoming-new-releases') ) :
        get_template_part( 'content', 'upcoming' );
        
    elseif( is_page('about') ) :
        get_template_part( 'content', 'about' );
        
    elseif( is_page('contact') ) :
        get_template_part( 'content', 'page' );
        
    else :
        get_template_part( 'content', 'page' );
    endif;
?>

<?php get_footer(); ?>