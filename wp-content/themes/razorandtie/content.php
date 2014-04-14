<?php
/**
 * The general template for displaying content.
 *
 * @package RazorAndTie
 * @since RazorAndTie 0.1
 */
?>

<!-- General Template -->
<section class="primary">
    <h2><?php wp_title(''); ?></h2>
    
    <div class="text"><?php the_content(); ?></div>
</section>