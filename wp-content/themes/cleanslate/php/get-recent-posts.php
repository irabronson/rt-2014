<?php
function get_recent_posts($category, $number, $template) {
    
    wp_reset_postdata();
    
    // Set Category
    if (!$category) {
        $category = 'projects';
    }
    
    // Set Number
    if (!$number) {
        $number = 1;
    }
    
    $orderBy = 'date';
    $order = 'DESC';
    
    $article_args = array(
        'category_name' => $category,
        'post_status' => array( 'publish', 'draft' ),
        'posts_per_page' => $number,
        'orderby'    => $orderBy,
        'order' => $order
    );
    
    $article_query = new WP_Query( $article_args );
    
    if ( $article_query->have_posts() ) :
        
        $articleHTML = '';
        
        while ( $article_query->have_posts() ) : $article_query->the_post();
            
            $articleHTML .= get_template_part($template);
            
        endwhile;
        
        return $articleHTML;
        
    else :
        return '';
    endif;
    
    wp_reset_postdata();
}
?>