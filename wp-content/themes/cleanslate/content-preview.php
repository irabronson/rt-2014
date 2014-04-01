<?php
/**
 * The template to display post previews.
 *
 * @package CleanSlate
 * @since CleanSlate 0.1
 */
?>

<a href="<?php the_permalink(); ?>" class="preview">
    <div class="caption">
        <h4 class="post-title">
            <?php the_title(); ?>
        </h4>
    </div>
    
    <figure class="post-thumb">
    <?php
        $thumb = get_thumbnail_custom($post->ID, 'thumbnail');
        
        if( $thumb ) {
    ?>
        <img src="<?php echo $thumb[0]; ?>" width="95" height="95" alt="<?php the_title(); ?>" />
    <?php
        }
    ?>
    </figure>
</a>