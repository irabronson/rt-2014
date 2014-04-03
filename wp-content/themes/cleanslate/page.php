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
    echo 'page';
    if( is_page('home') || is_home() ) :
        // get_template_part( 'content', 'home' );
        
    elseif( is_page('artists') ) :
        
        // Set arguments
        $args = array(
            'post_type' => 'artist',
            'orderby' => 'meta_value',
            'meta_key' => 'artist_list_display_name',
            'order' =>  'ASC'
        );
        
        // Query Artist Post Type
        $artist_query = new WP_Query( $args );
        include('content-artists.php');
        
    elseif( is_page('upcoming-new-releases') ) :
        get_template_part( 'content', 'upcoming' );
        
    elseif( is_page('about') ) :
        echo 'about';
        
    elseif( is_page('contact') ) :
        echo 'contact';
        
    else :
        // get_template_part( 'content', 'page' );
    endif;
?>

<?php get_footer(); ?>