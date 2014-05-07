<?php
/**
 * The Template for displaying a password form on protected posts.
 *
 * @package RazorAndTie
 * @since RazorAndTie 0.1
 */
?>

<!-- Content-Passwrod-Form Template -->
<section class="primary">
    <div class="section-inner">
        <!-- Artist Title -->
        <h2><?php the_title(); ?></h2>
        <?php echo get_the_password_form(); ?>
    </div>
</section>