<?php
/**
 *  Sub-Template:
 *  Loaded via page.php
 *  For displaying generic pages.
 *
 * @package RazorAndTie
 * @since RazorAndTie 0.1
 */
?>

<!-- Default Page Template -->
<section class="primary">
  <section class="section-inner">
    <h2><?php wp_title(''); ?></h2>
    <div class="text"><?php echo apply_filters('the_content', $post->post_content); ?></div>
  </section><!-- .section-inner -->    
</section>