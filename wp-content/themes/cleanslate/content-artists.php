<?php
    if ( $artist_query->have_posts() ) :
        _log($artist_query);
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
            <div class="artist">
                <a href="<?php the_permalink(); ?>" data-filter="<?php echo $slug; ?>">
                    <?php the_post_thumbnail('thumbnail'); ?>
                    <p><?php the_field('artist_list_display_name'); ?></p>
                </a>
            </div>
    <?php
        endwhile;
        
    else :
    // Content Not Found Template
    include('content-not-found.php');
?>
    </div>
<?php
    endif;
?>