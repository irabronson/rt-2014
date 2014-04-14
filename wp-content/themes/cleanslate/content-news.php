<?php
/**
 *  Sub-Template:
 *  Loaded via AJAX on the homepage
 *  For displaying regular posts in the 'News' category.
 *
 * @package RazorAndTie
 * @since RazorAndTie 0.1
 */
?>

<!-- Content-News Template -->
<?php
    // Alter pagination setting
    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
    
    $args = array(
      'posts_per_page' => 5,
      'paged' => $paged
    );
    
    query_posts($args); 
    
    if ( have_posts() ) :
?>
    <section class="news-wrapper">
<?php
        while ( have_posts() ) : the_post();
?>
            <div class="news-post">
<?php
            if( get_field('news_press_asset') ) :
                $attachment = get_field('news_press_asset');
?>
                <a href="<?php echo $attachment[0]->guid; ?>">
                    <span class="date"><?php echo date('M d', strtotime(get_the_date())); ?></span>
                    <span class="title"><?php the_title(); ?></span>
                    <span class="type"><?php the_field('news_press_asset_type'); ?></span>
                </a>
<?php
            else :
?>
                <span class="date"><?php echo date('M d', strtotime(get_the_date())); ?></span>
                <span class="title"><?php the_title(); ?></span>
<?php
            endif;
?>
            </div>
<?php
        endwhile;
?>
        <div id="pagination">
            <?php
                $big = 999999999; // need an unlikely integer
                
                echo paginate_links( array(
                    'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
                    'format' => '?paged=%#%',
                    'current' => max( 1, get_query_var('paged') ),
                    'total' => $wp_query->max_num_pages,
                    'prev_next'    => True,
                    'prev_text'    => __('&larr;'),
                    'next_text'    => __('&rarr;'),
                ) );
            ?>
        </div>
    </section><!-- .news -->
<?php
    else :
        // Content Not Found Template
        include('content-not-found.php');
    endif;
?>