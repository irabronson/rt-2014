<?php
/**
 * The general template used for displaying page content in page.php.
 *
 * @package CleanSlate
 * @since CleanSlate 0.1
 */
?>


<section>
    
    <h2><?php wp_title(''); ?></h2>
    
    <div class="text"><?php the_content(); ?></div>
    
</section>