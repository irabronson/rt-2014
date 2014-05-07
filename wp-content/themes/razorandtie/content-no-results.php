<?php
/**
 * The template used for displaying when no search results are found.
 *
 * @package RazorAndTie
 * @since RazorAndTie 0.1
 */
?>

<!-- Content-No-Results Template -->
<section class="primary">
    <div class="section-inner">
        <p class="not-found">Sorry, there are no results for " <?php the_search_query() ?> ".</p>
    </div>
</section>