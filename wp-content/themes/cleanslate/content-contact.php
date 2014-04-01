<?php
/**
 * The general template used for displaying page content in page.php.
 *
 * @package CleanSlate
 * @since CleanSlate 0.1
 */
?>

<section id="primary">
    <div id="map-canvas">
    </div>
    
    <div class="title">
        <div class="wrapper">
            <h2><?php wp_title(''); ?></h2>
        </div>
    </div>
    
</section>

<section id="secondary">
    
    <div class="text"><?php the_content(); ?></div>
    
    <div id="sidebar" data-address="<?php echo get_field('map_address'); ?>">
        <?php the_field('contact_sidebar'); ?>
    </div>
    
</section>