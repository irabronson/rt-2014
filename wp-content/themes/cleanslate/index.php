<?php
/**
 * The main template file.
 *
 * @package CleanSlate
 * @since CleanSlate 0.1
 */
?>

<?php get_header(); ?>

<section class="primary">
    
    <ul class="filters">
        <?php
            $razorTieCategory = get_term( 2, 'artists' );
            $razorTieKidsCategory = get_term( 3, 'artists' );
            $washSqCategory = get_term( 4, 'artists' );
        ?>
        <li>
            <a href="#">All</a>
        </li>
        <li>
            <a href="#"><?php echo $razorTieCategory->name; ?></a>
        </li>
        <li>
            <a href="#"><?php echo $razorTieKidsCategory->name; ?></a>
        </li>
        <li>
            <a href="#"><?php echo $washSqCategory->name; ?></a>
        </li>
    </ul>
    
    <?php
        // Query Artist Post Type
        $args = array(
            'post_type' => 'artist',
            'meta_key' => 'artist_list_display_name',
            'orderby' => 'meta_value',
            'order' => 'ASC',
            'posts_per_page' => -1
        );
        $artist_query = new WP_Query( $args );
        
        include('content-artists.php');
        
    ?>
    
</section>

<section class="secondary">
<?php
    // Reset after custom query
    wp_reset_postdata();
    
    // Alter pagination setting
    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
    $args = array(
      'posts_per_page' => 2,
      'paged' => $paged
    );
    
    query_posts($args); 
    
    if ( have_posts() ) :
?>
    <div class="news">
<?php
        while ( have_posts() ) : the_post();
?>
            <div class="news-post">
<?php
            if( get_field('news_press_asset') ) :
                $attachment = get_field('news_press_asset');
?>
                <a href="<?php echo $attachment[0]->guid; ?>">
                    <span class="date"><?php echo get_the_date(); ?></span>
                    <span class="title"><?php the_title(); ?></span>
                    <span class="type"><?php the_field('news_press_asset_type'); ?></span>
                </a>
<?php
            else :
?>
                <span class="date"><?php echo get_the_date(); ?></span>
                <span class="title"><?php the_title(); ?></span>
<?php
            endif;
?>
            </div>
<?php
        endwhile;
?>
    </div>
    <div id="pagination">
        <div class="previous"><?php next_posts_link( '>' ); ?></div>
        <div class="next"><?php previous_posts_link( '<' ); ?></div>
    </div>
<?php
    else :
        // Content Not Found Template
        include('content-not-found.php');
    endif;
?>
</section>

<?php get_footer(); ?>