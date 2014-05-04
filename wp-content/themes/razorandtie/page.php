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
?>
    <section class="primary">
      <div class="section-inner artists-inner">
        <h2><?php the_title(); ?></h2>
        <!-- Display toggle -->
        <div id="toggle-display">
          <a href="#" id="image-display" class="active">Image</a>
          <a href="#" id="text-display">Text</a>
        </div>
      </div><!-- .section-inner -->
      
<?php
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
?>
    </section>
<?php
        
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