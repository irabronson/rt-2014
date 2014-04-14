<?php
/**
 *  Sub-Template:
 *  Loaded on several pages, including Home and Archive pages.
 *  For displaying artist posts in list-format.
 *
 * @package RazorAndTie
 * @since RazorAndTie 0.1
 */
?>

<!-- Content-Artists Template -->
<?php
    if ( $artist_query->have_posts() ) :
?>
    <div class="artists">
    <?php
        while ( $artist_query->have_posts() ) : $artist_query->the_post();
            
            $categories = get_the_terms($post->ID, 'artists');
            
            // What to do if more than one category?
            foreach ( $categories as $category ) {
                $slug = $category->slug;
            }
    ?>
            <div class="artist" data-filter="<?php echo $slug; ?>">
                <a href="<?php the_permalink(); ?>">
                    <?php the_post_thumbnail('thumbnail'); ?>
                    <p><?php the_field('artist_list_display_name'); ?></p>
                </a>
            </div>
    <?php
        endwhile;
?>
    </div>
<?php
    else :
        // Content Not Found Template
        include('content-not-found.php');
    endif;
?>