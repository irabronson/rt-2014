<?php
/**
* Plugin Name: Custom Post Type: Artist
* Plugin URI: http://sakisato.com
* Description: Add a custom post type called "Artist" to WordPress.
* Version: 1.0
* Author: Saki Sato
* Author URI: http://sakisato.com
* License: GPL2
*/

/*  Copyright 2014  Saki Sato  (email : saki.s.sato@gmail.com)
    
    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.
    
    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.
    
    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/


function custom_post_type_artist() {
    
	$labels = array(
		'name'               => _x( 'Artists', 'post type general name' ),
		'singular_name'      => _x( 'Artist', 'post type singular name' ),
		'add_new'            => _x( 'Add New', 'artist' ),
		'add_new_item'       => __( 'Add New Artist' ),
		'edit_item'          => __( 'Edit Artist' ),
		'new_item'           => __( 'New Artist' ),
		'all_items'          => __( 'All Artists' ),
		'view_item'          => __( 'View Artist' ),
		'search_items'       => __( 'Search Artists' ),
		'not_found'          => __( 'No artists found' ),
		'not_found_in_trash' => __( 'No artists found in the Trash' ), 
		'parent_item_colon'  => '',
		'menu_name'          => 'Artists'
	);
	$args = array(
		'labels'        => $labels,
		'description'   => 'Holds data about each artist.',
		'public'        => true,
		'menu_position' => 5,
		'supports'      => array( 'title', 'editor', 'thumbnail', 'excerpt', 'comments' ),
		'has_archive'   => true,
	);
    
	register_post_type( 'artist', $args );
}
add_action( 'init', 'custom_post_type_artist' );

function artist_updated_messages( $messages ) {
	global $post, $post_ID;
	$messages['artist'] = array(
		0 => '', 
		1 => sprintf( __('Artist updated. <a href="%s">View artist</a>'), esc_url( get_permalink($post_ID) ) ),
		2 => __('Custom field updated.'),
		3 => __('Custom field deleted.'),
		4 => __('Artist updated.'),
		5 => isset($_GET['revision']) ? sprintf( __('Artist restored to revision from %s'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
		6 => sprintf( __('Artist published. <a href="%s">View artist</a>'), esc_url( get_permalink($post_ID) ) ),
		7 => __('Product saved.'),
		8 => sprintf( __('Artist submitted. <a target="_blank" href="%s">Preview artist</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
		9 => sprintf( __('Artist scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview artist</a>'), date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
		10 => sprintf( __('Artist draft updated. <a target="_blank" href="%s">Preview artist</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
	);
	return $messages;
}
add_filter( 'post_updated_messages', 'artist_updated_messages' );

function custom_taxonomies_artist() {
	$labels = array(
		'name'              => _x( 'Artist Categories', 'taxonomy general name' ),
		'singular_name'     => _x( 'Artist Category', 'taxonomy singular name' ),
		'search_items'      => __( 'Search Artist Categories' ),
		'all_items'         => __( 'All Artist Categories' ),
		'parent_item'       => __( 'Parent Artist Category' ),
		'parent_item_colon' => __( 'Parent Artist Category:' ),
		'edit_item'         => __( 'Edit Artist Category' ), 
		'update_item'       => __( 'Update Artist Category' ),
		'add_new_item'      => __( 'Add New Artist Category' ),
		'new_item_name'     => __( 'New Artist Category' ),
		'menu_name'         => __( 'Artist Categories' ),
	);
	$args = array(
		'labels' => $labels,
		'hierarchical' => true,
	);
	register_taxonomy( 'artist_category', 'artist', $args );
}
add_action( 'init', 'custom_taxonomies_artist', 0 );


// // Show posts of 'post', 'page' and 'artist' post types on home page
// function add_artist_posts_to_query( $query ) {
//     if ( is_home() && $query->is_main_query() )
//         $query->set( 'post_type', array( 'artist' ) );
//     return $query;
// }
// add_action( 'pre_get_posts', 'add_artist_posts_to_query' );
