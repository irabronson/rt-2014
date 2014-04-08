<?php
    // For the News category
    // Loaded via AJAX
?>
<?php
    // Alter pagination setting
    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
    
    $args = array(
      'posts_per_page' => 2,
      'paged' => $paged
    );
    
    query_posts($args); 
    
    if ( have_posts() ) :
?>
    <div class="news">
<?php
        while ( have_posts() ) : the_post();
?>
            <div class="news-post">
<?php
            if( get_field('news_press_asset') ) :
                $attachment = get_field('news_press_asset');
?>
                <a href="<?php echo $attachment[0]->guid; ?>">
                    <span class="date"><?php echo get_the_date(); ?></span>
                    <span class="title"><?php the_title(); ?></span>
                    <span class="type"><?php the_field('news_press_asset_type'); ?></span>
                </a>
<?php
            else :
?>
                <span class="date"><?php echo get_the_date(); ?></span>
                <span class="title"><?php the_title(); ?></span>
<?php
            endif;
?>
            </div>
<?php
        endwhile;
?>
        <div id="pagination">
            <div class="previous" data-paged="<?php echo ($paged - 1); ?>"><?php previous_posts_link( '&larr; Previous' ); ?></div>
            <div class="next" data-paged="<?php echo ($paged + 1); ?>"><?php next_posts_link( 'Next &rarr;' ); ?></div>
        </div>
    </div>
<?php
    else :
        // Content Not Found Template
        include('content-not-found.php');
    endif;
?>