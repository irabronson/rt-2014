<?php
    // For the News category
    
    // Get post image
    $image = get_thumbnail_custom($post->ID, 'medium');
    $imageClass = ( $image != '' ? '' : ' no-image' );
?>
<div class="single-post">
    <div class="post-head">
        <h3><?php the_title(); ?></h3>
        <?php include('content-social.php'); ?>
    </div>
    <div class="text<?php echo $imageClass; ?>"><?php the_content(); ?></div>
    <?php
        if( $image ) {
    ?>
    <figure>
        <img src="<?php echo $image[0]; ?>" width="<?php echo $image[1]; ?>" height="<?php echo $image[2]; ?>" alt="<?php the_title(); ?>" />
    </figure>
    <?php
        }
    ?>
</div>