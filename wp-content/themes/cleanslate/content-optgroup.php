<?php
/**
 *  Sub--sub-Template:
 *  Loaded via content-artist-detail.php
 *  For displaying option groups in the select element.
 *
 * @package RazorAndTie
 * @since RazorAndTie 0.1
 */
?>

<?php
    if ( $artist_cat_query->have_posts() ) :
?>
    <optgroup label="<?php echo $title; ?>">
<?php
        while ( $artist_cat_query->have_posts() ) : $artist_cat_query->the_post();
            
            $display_name = get_post_meta($post->ID, 'artist_list_display_name');
?>
    <option value="<?php echo $post->guid; ?>"><?php echo $display_name[0]; ?></option>
<?php
        endwhile;
?>
    </optgroup>
<?php
    endif;
    
    wp_reset_postdata();
?>