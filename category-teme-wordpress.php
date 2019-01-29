<?php

/**
 * Archive Post Class
 * @since 1.0.0
 *
 * Breaks the posts into three columns
 * @link http://www.billerickson.net/code/grid-loop-using-post-class
 *
 * @param array $classes
 * @return array
 */

function be_archive_post_class( $classes ) {
	global $wp_query;
	if( ! $wp_query->is_main_query() )
		return $classes;

	$classes[] = 'one-half';
	if( 0 == $wp_query->current_post % 2 )
		$classes[] = 'first';
	return $classes;
}
add_filter( 'post_class', 'be_archive_post_class' );

 //* Remove the breadcrumb navigation
 remove_action( 'genesis_before_loop', 'genesis_do_breadcrumbs' );
 //* Remove the post content
 remove_action( 'genesis_entry_content', 'genesis_do_post_content' );
 //* Remove the post image
 //remove_action( 'genesis_entry_content', 'genesis_do_post_image', 8 );
 //* Remove the post meta function
 remove_action( 'genesis_entry_footer', 'genesis_post_meta' );
 remove_action( 'genesis_entry_header', 'genesis_post_info', 12 );

 genesis();
