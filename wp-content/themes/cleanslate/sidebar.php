<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package CleanSlate
 * @since CleanSlate 0.1
 */
?>

<div id="sidebar">
    <div class="recent-posts">
        <?php echo get_recent_posts('news', 2, 'content-preview'); ?>
    </div>
</div>