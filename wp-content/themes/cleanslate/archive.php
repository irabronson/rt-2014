<?php
/**
 *  Template:
 *  Loaded on Category Archive pages, like 'Washington Square'.
 *  For displaying all posts on Archive pages.
 *
 * @package RazorAndTie
 * @since RazorAndTie 0.1
 */
?>

<?php get_header(); ?>

<!-- Archive Template -->
<?php
    // Define global args for artist_query
    $args = array(
        'post_type' => 'artist',
        'orderby' => 'meta_value',
        'meta_key' => 'artist_list_display_name',
        'order' =>  'ASC',
        'posts_per_page' => -1
    );
    
    // Set args based on category
    if( is_tax('artists','razor-tie') ) :
        $args['artists'] = 'razor-tie';
        
    elseif( is_tax('artists','razor-tie-kids') ) :
        $args['artists'] = 'razor-tie-kids';
        
    elseif( is_tax('artists','washington-square') ) :
        $args['artists'] = 'washington-square';
        
    else :
        // do nothing
        
    endif;
    
    // Query Artist Post Type
    $artist_query = new WP_Query( $args );
    
    include('content-artists.php');
?>

<?php get_footer(); ?>