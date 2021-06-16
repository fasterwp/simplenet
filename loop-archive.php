<?php

add_filter( 'body_class', 'custom_body_class' );
/**
 * Add `content-archive` class to the body element.
 *
 * @param  array $classes the current body classes
 * @return array $classes modified classes
 */
function custom_body_class( $classes ) {
    $classes[] = 'content-archive';

    return $classes;
}

// Force full width content.
add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );

// Add opening div.articles tag before the latest post.
add_action( 'genesis_before_entry', function () {
    global $wp_query;

    if ( 0 === $wp_query->current_post && is_main_query() ) {
        echo '<div class="articles">';
    }
} );

// Remove all hooks from genesis_entry_header, genesis_entry_content and genesis_entry_footer actions.
$hooks = array(
    'genesis_entry_header',
    'genesis_entry_content',
    'genesis_entry_footer',
);

foreach( $hooks as $hook ) {
    remove_all_actions( $hook );
}

// Add featured image inside entry header.
add_action( 'genesis_entry_header', 'genesis_entry_header_markup_open' );
add_action( 'genesis_entry_header', 'genesis_do_post_image' );
add_action( 'genesis_entry_header', 'genesis_entry_header_markup_close' );

// Add entry title and entry meta in entry content.
add_action( 'genesis_entry_content', 'genesis_do_post_title' );
//add_action( 'genesis_entry_content', 'genesis_do_post_content' );
add_action( 'genesis_entry_content', 'genesis_post_meta' );

add_filter( 'genesis_post_meta', 'custom_post_meta_filter' );
/**
 * Customize entry meta.
 * @param  string $post_meta Existing entry meta
 * @return string            Modified entry meta
 */
function custom_post_meta_filter( $post_meta ) {
    $post_meta = '[post_categories before=""]';

    return $post_meta;
}

// Move .archive-pagination from under main.content to adjacent to it.
remove_action( 'genesis_after_endwhile', 'genesis_posts_nav' );
add_action( 'genesis_after_content', 'genesis_posts_nav' );

// Add closing div tag (for .articles) after the last post.
add_action( 'genesis_after_endwhile', function () {
    if ( is_main_query() ) {
        echo '</div>';
    }
} );
