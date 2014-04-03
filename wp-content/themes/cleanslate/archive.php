<?php
/**
 * The template for displaying Archive pages.
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package CleanSlate
 * @since CleanSlate 0.1
 */
?>

<?php get_header(); ?>
    
    <?php echo 'archive page'; ?>
    
    <?php
        // Define global args for artist_query
        $args = array(
            'post_type' => 'artist',
            'orderby' => 'meta_value',
            'meta_key' => 'artist_list_display_name',
            'order' =>  'ASC'
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