<?php
/**
 * @author  Brad Dalton
 * @link    http://wpsites.net/web-design/list-titles-only-on-search-results-page/
 */

//* Remove breadcrumbs
remove_action( 'genesis_before_loop', 'genesis_do_breadcrumbs' );

//* Remove the post meta function
//remove_action( 'genesis_entry_footer', 'genesis_post_meta' );

//* Remove the post info function
remove_action( 'genesis_entry_header', 'genesis_post_info', 12 );

//* Remove the post image (requires HTML5 theme support)
remove_action( 'genesis_entry_content', 'genesis_do_post_image', 8 );

//* Remove the post content
remove_action( 'genesis_entry_content', 'genesis_do_post_content' );


genesis();
