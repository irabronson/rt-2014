<?php
/**
 * The template to display post thumbnails.
 *
 * @package CleanSlate
 * @since CleanSlate 0.1
 */
?>

<?php
    $postTags = get_the_tags();
    $tagClasses = '';
    
    if( $postTags ) :
        foreach($postTags as $postTag) :
            $tagClasses .= ' tag-' . $postTag->term_id;
        endforeach;
    endif;
    
    if( is_category('news') ) :
        $permalink = '#';
    else :
        $permalink = get_permalink();
    endif;
?>

<div class="thumb-wrapper<?php echo $tagClasses; ?>">
    <a href="<?php echo $permalink; ?>" class="thumb">
        
        <div class="arrow"></div>
        
        <div class="caption">
            <p class="post-title"><?php the_title(); ?></p>
        </div>
        
        <?php
            // Get post thumbnail
            // If none, shows nothing
            $thumb = get_thumbnail_custom($post->ID, 'thumbnail');
            
            if( $thumb ) {
        ?>
        <figure class="post-thumb">
            <img src="<?php echo $thumb[0]; ?>" width="<?php echo $thumb[1]; ?>" height="<?php echo $thumb[2]; ?>" alt="<?php the_title(); ?>" />
        </figure>
        <?php
            }
        ?>
    </a>
<?php
    // Include single post content
    // For the News category
    if( is_category('news') ) :
        include('content-news.php');
    endif;
?>
</div>