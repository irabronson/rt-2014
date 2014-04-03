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
            'posts_per_page' => 9999
        );
        $artist_query = new WP_Query( $args );
        
        include('content-artists.php');
    ?>
    
</section>

<?php get_footer(); ?>