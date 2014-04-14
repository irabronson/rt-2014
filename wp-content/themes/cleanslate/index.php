<?php
/**
 *  Template:
 *  Loaded on the homepage.
 *  For displaying all info on the homepage.
 *
 * @package CleanSlate
 * @since CleanSlate 0.1
 */
?>

<?php get_header(); ?>

<!-- Home Template -->
<section class="primary">
    
    <ul id="filters">
        <?php
            $razorTieCategory = get_term( 2, 'artists' );
            $razorTieKidsCategory = get_term( 3, 'artists' );
            $washSqCategory = get_term( 4, 'artists' );
        ?>
        <li>
            <a href="#" data-filter="all">All</a>
        </li>
        <li>
            <a href="#" data-filter="<?php echo $razorTieCategory->slug; ?>"><?php echo $razorTieCategory->name; ?></a>
        </li>
        <li>
            <a href="#" data-filter="<?php echo $washSqCategory->slug; ?>"><?php echo $washSqCategory->name; ?></a>
        </li>
        <li>
            <a href="#" data-filter="<?php echo $razorTieKidsCategory->slug; ?>"><?php echo $razorTieKidsCategory->name; ?></a>
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

<section id="news">
<?php
    // Get news posts
    include('content-news.php');
?>
</section>

<?php get_footer(); ?>