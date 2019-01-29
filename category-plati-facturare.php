<?php
/**
 * @author    Brad Dalton
 * @example   https://wpsites.net/web-design/how-to-show-only-titles-on-archive-pages-in-genesis/
 */

 //* Remove the breadcrumb navigation
 remove_action( 'genesis_before_loop', 'genesis_do_breadcrumbs' );
 //* Remove the post content
 remove_action( 'genesis_entry_content', 'genesis_do_post_content' );
 //* Remove the post image
 remove_action( 'genesis_entry_content', 'genesis_do_post_image', 8 );
 //* Remove the post meta function
 //remove_action( 'genesis_entry_footer', 'genesis_post_meta' );
 remove_action( 'genesis_entry_header', 'genesis_post_info', 12 );

 genesis();
