<?php
/**
 * The main template file.
 *
 * @package CleanSlate
 * @since CleanSlate 0.1
 */
?>

<?php get_header(); ?>

<section id="primary">
    
    <ul class="filters">
        <?php
            $razorTieCategory = get_term( 3, 'artist_category' );
            $razorTieKidsCategory = get_term( 4, 'artist_category' );
            $washSqCategory = get_term( 5, 'artist_category' );
        ?>
        <li>
            <a href="<?php get_term_link( '3', 'artist_category' ); ?>"><?php echo $razorTieCategory->name; ?></a>
        </li>
        <li>
            <a href="<?php get_term_link( '4', 'artist_category' ); ?>"><?php echo $razorTieKidsCategory->name; ?></a>
        </li>
        <li>
            <a href="<?php get_term_link( '5', 'artist_category' ); ?>"><?php echo $washSqCategory->name; ?></a>
        </li>
    </ul>
    
    <?php
        // Query Artist Post Type
        $args = array( 'post_type' => 'artist', 'posts_per_page' => 9999 );
        $artist_query = new WP_Query( $args );
        
        if ( $artist_query->have_posts() ) :
            
            while ( $artist_query->have_posts() ) : $artist_query->the_post();
                
                $categories = get_the_terms($post->ID, 'artist_category');
                
                // What to do if more than one category?
                foreach ( $categories as $category ) {
                    $slug = $category->slug;
                }
        ?>
                <a href="<?php the_permalink(); ?>" data-filter="<?php echo $slug; ?>"><?php the_title(); ?></a>
        <?php
            endwhile;
        
        else :
        // Content Not Found Template
        include('content-not-found.php');
    
        endif;
    ?>
</section>

<?php get_footer(); ?>