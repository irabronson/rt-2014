<?php
/**
 *  Template:
 *  Loaded on the homepage.
 *  For displaying all info on the homepage.
 *
 * @package RazorAndTie
 * @since RazorAndTie 0.1
 */
?>

<?php get_header(); ?>

<!-- Home Template -->
<section class="primary">
  
  <div class="section-inner">
    <!-- Artist filters -->
    <ul id="filters">
      <?php
          $razorTieCategory = get_term( 2, 'artists' );
          $razorTieKidsCategory = get_term( 3, 'artists' );
          $washSqCategory = get_term( 4, 'artists' );
      ?>
      <li>
          <a href="#" data-filter="all">All</a>
      </li>
      <li>
          <a href="#" data-filter="<?php echo $razorTieCategory->slug; ?>"><?php echo $razorTieCategory->name; ?></a>
      </li>
      <li>
          <a href="#" data-filter="<?php echo $washSqCategory->slug; ?>"><?php echo $washSqCategory->name; ?></a>
      </li>
      <li>
          <a href="#" data-filter="<?php echo $razorTieKidsCategory->slug; ?>"><?php echo $razorTieKidsCategory->name; ?></a>
      </li>
    </ul>
    
    <!-- Display toggle -->
    <div id="toggle-display">
      <a href="#" id="image-display" class="active">Image</a>
      <a href="#" id="text-display">Text</a>
    </div>
  </div> <!-- /.section-inner -->
      
      <?php
          // Query Artist Post Type
          $args = array(
              'post_type' => 'artist',
              'meta_key' => 'artist_list_display_name',
              'orderby' => 'meta_value',
              'order' => 'ASC',
              'posts_per_page' => -1
          );
          
          // Check user status for permission to view protected posts
          if( is_user_logged_in() === false ) :
              $args['has_password'] = false;
          endif;
          
          // Query Artist Post Type
          $artist_query = new WP_Query( $args );
          
          include('content-artists.php');
      ?>
      
</section> <!-- /.primary -->

<section id="news">
  <div class="news-trigger-container">
    <div class="news-trigger"></div>
    <div class="news-trigger-bg"><span></span></div>
  </div>
  <?php
      // Get news posts
      include('content-news.php');
  ?>
</section>

<?php get_footer(); ?>