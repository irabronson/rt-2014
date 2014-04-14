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
<section class="primary">
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
        $title = 'Razor &amp; Tie';
        
    elseif( is_tax('artists','washington-square') ) :
        $args['artists'] = 'washington-square';
        $title = 'Washington Square';
        
    elseif( is_tax('artists','razor-tie-kids') ) :
        $args['artists'] = 'razor-tie-kids';
        $title = 'Razor &amp; Tie Kids';
        
    else :
        // do nothing
        
    endif;
?>
    <h2>Artists: <?php echo $title; ?></h2>
<?php
    // Query Artist Post Type
    $artist_query = new WP_Query( $args );
    
    include('content-artists.php');
?>
</section>

<?php get_footer(); ?>