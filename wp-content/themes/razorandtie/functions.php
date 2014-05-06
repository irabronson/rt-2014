<?php
/**
 * Cleanslate functions and definitions
 *
 * @package RazorAndTie
 * @since RazorAndTie 0.1
 */

 // DEBUGGING
 if(!function_exists('_log')){
     function _log( $message ) {
         if( WP_DEBUG === true ){
             if( is_array( $message ) || is_object( $message ) ){
                 error_log( print_r( $message, true ) );
             } else {
                 error_log( $message );
             }
         }
     }
 }

  if ( ! function_exists( 'razorandtie_setup' ) ):
 /**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * To override razorandtie_setup() in a child theme, add your own razorandtie_setup to your child theme's
 * functions.php file.
 */
 function razorandtie_setup() {
  /**
   * Add default posts and comments RSS feed links to head
   */
  add_theme_support( 'automatic-feed-links' );

  /**
   * This theme uses wp_nav_menu() in two locations.
   */
  register_nav_menus( array(
      'primary' => __( 'Primary Menu', 'razorandtie' ),
      'footer' => __( 'Footer Menu', 'razorandtie' ),
  ) );

  /**
   * Add support for the Gallery and Video Post Formats
   */
  // add_theme_support( 'post-formats', array( 'gallery' ) );
 }
 endif; // razorandtie_setup

 /**
 * Tell WordPress to run razorandtie_setup() when the 'after_setup_theme' hook is run.
 */
 add_action( 'after_setup_theme', 'razorandtie_setup' );

 /**
 * Register widgetized area and update sidebar with default widgets
 */

 if ( function_exists ('register_sidebar')) { 
  // register_sidebar( array(
  //     'name' => __( 'cat-posts' ),
  //     'id' => 'cat-posts'
  // ) );

  register_sidebar();
 }
 // add_action( 'init', 'razorandtie_widgets_init' );

 // Add and enqueue jQuery
 function register_jquery() {
     wp_enqueue_script( 'jquery' );
 }
 add_action('wp_enqueue_scripts', 'register_jquery');

function get_first_attachment() {
    global $post;

    $id = $post->ID;
    $attachments = get_children( array('post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => 'DESC', 'orderby' => 'menu_order ASC') );
    $tpl = get_bloginfo('template_url');
    // $nothing = $tpl.'/nothing.jpg';
    $nothing = '';

    if ( empty($attachments) )
        return $nothing;

        foreach ( $attachments as $id => $attachment )
            $link = wp_get_attachment_url($id);
        return $link;
}

function the_excerpt_max_charlength($charlength) {
    $excerpt = get_the_excerpt();
    $charlength++;
    
    if ( mb_strlen( $excerpt ) > $charlength ) {
        $subex = mb_substr( $excerpt, 0, $charlength - 5 );
        $exwords = explode( ' ', $subex );
        $excut = - ( mb_strlen( $exwords[ count( $exwords ) - 1 ] ) );
        if ( $excut < 0 ) {
            echo mb_substr( $subex, 0, $excut );
        } else {
            echo $subex;
        }
        // echo '[...]';
    } else {
        echo $excerpt;
    }
}

function the_excerpt_max_words($word_limit) {
    $excerpt = get_the_excerpt();
    $words = explode(" ", $excerpt);
    
    if ( $words > $word_limit ) {
        echo implode(" ", array_splice($words, 0, $word_limit));
    } else {
        echo $excerpt;
    }
}

function get_category_tags($args) {
	global $wpdb;
	$tags = $wpdb->get_results
	("
		SELECT DISTINCT terms2.term_id as tag_id, terms2.name as tag_name, null as tag_link
		FROM
			wp_posts as p1
			LEFT JOIN wp_term_relationships as r1 ON p1.ID = r1.object_ID
			LEFT JOIN wp_term_taxonomy as t1 ON r1.term_taxonomy_id = t1.term_taxonomy_id
			LEFT JOIN wp_terms as terms1 ON t1.term_id = terms1.term_id,

			wp_posts as p2
			LEFT JOIN wp_term_relationships as r2 ON p2.ID = r2.object_ID
			LEFT JOIN wp_term_taxonomy as t2 ON r2.term_taxonomy_id = t2.term_taxonomy_id
			LEFT JOIN wp_terms as terms2 ON t2.term_id = terms2.term_id
		WHERE
			t1.taxonomy = 'category' AND p1.post_status = 'publish' AND terms1.term_id IN (".$args['categories'].") AND
			t2.taxonomy = 'post_tag' AND p2.post_status = 'publish'
			AND p1.ID = p2.ID
		ORDER by tag_name
	");
    // $count = 0;
    // foreach ($tags as $tag) {
    //     $tags[$count]->tag_link = get_tag_link($tag->tag_id);
    //     $count++;
    // }
	return $tags;
}

function custom_query_var( $query ) {
    if ( is_admin() || ! $query->is_main_query() )
        return;
    
    if ( is_category('projects') ) {
        // Display only 1 post for the original blog archive
        $query->set( 'posts_per_page', -1 );
        return;
    }
}
add_action( 'pre_get_posts', 'custom_query_var', 1 );

// Adding Thumbnails
add_theme_support( 'post-thumbnails' );

// Add custom classes
function custom_body_classes( $classes ) {
    global $post;
    
    // Adds the page name (slug) as a class
    if ( is_page() ) {
        $classes[] = $post->post_name;
    }
    
    return $classes;
}
add_filter( 'body_class', 'custom_body_classes' );

// CUSTOM ADMIN MENUS
// Add 'Read' to menu
function news_menu() {
    add_submenu_page('edit.php', 'News', 'News', 'manage_options', 'edit.php?category_name=news' );
}
add_action('admin_menu', 'news_menu');

function projects_menu() {
    add_submenu_page('edit.php', 'Projects', 'Projects', 'manage_options', 'edit.php?category_name=projects' );
}
add_action('admin_menu', 'projects_menu');

// Adding Thumbnails
add_theme_support( 'post-thumbnails' );

// Adding Custom Thumbnail Size
add_image_size( 'small-thumbnail', 250, 250, true );

// Prevent from adding link to inserted imgaes
update_option('image_default_link_type','none');

// Custom Thumbnail Retreival
include('php/get-thumbnail-custom.php');

// Added to extend allowed files types in Media upload
// See more at: http://itswordpress.com/featured/add-additional-file-types-to-wordpress-media-library/#sthash.yZtx2ZLg.dpuf
add_filter('upload_mimes', 'custom_upload_mimes');
function custom_upload_mimes ( $existing_mimes=array() ) {
    // Add *.EPS files to Media upload
    $existing_mimes['eps'] = 'application/postscript';
    
    // Add *.AI files to Media upload
    $existing_mimes['ai'] = 'application/postscript';
    
    return $existing_mimes;
}
/**
 * This theme was built with PHP, Semantic HTML, CSS, love, and a Toolbox.
 */