<?php
/**
 * Startup Pro
 *
 * This file adds the front page template to the child theme.
 *
 * @package   SeoThemes\StartupPro
 * @link      https://seothemes.com/startup-pro
 * @author    SEO Themes
 * @copyright Copyright © 2018 SEO Themes
 * @license   GPL-3.0-or-later
 */

// Check if any front page widgets are active.
if ( 'page' === get_option( 'show_on_front' ) && (
		is_active_sidebar( 'front-page-1' ) ||
		is_active_sidebar( 'front-page-2' ) ||
		is_active_sidebar( 'front-page-3' ) ||
		is_active_sidebar( 'front-page-4' ) ||
		is_active_sidebar( 'front-page-5' ) ||
		is_active_sidebar( 'front-page-6' ) ||
		is_active_sidebar( 'front-page-7' ) ||
		is_active_sidebar( 'front-page-8' ) ||
		is_active_sidebar( 'front-page-9' ) ) ) {

	// Force full-width-content layout.
	add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );

	// Remove content-sidebar-wrap.
	add_filter( 'genesis_markup_content-sidebar-wrap', '__return_null' );

	// Remove default loop.
	remove_action( 'genesis_loop', 'genesis_do_loop' );

	// Add custom loop.
	add_action( 'genesis_loop', function () {
		ob_start();
		the_custom_header_markup();
		$custom_header = ob_get_clean();

		genesis_widget_area( 'front-page-1', array(
			'before' => '<div class="front-page-1 widget-area">' . $custom_header . '<div class="wrap">',
			'after'  => '</div></div>',
		) );
		genesis_widget_area( 'front-page-2', array(
			'before' => '<div class="front-page-2 widget-area"><div class="wrap">',
			'after'  => '</div></div>',
		) );
		genesis_widget_area( 'front-page-3', array(
			'before' => '<div class="front-page-3 widget-area"><div class="wrap">',
			'after'  => '</div></div>',
		) );
		genesis_widget_area( 'front-page-4', array(
			'before' => '<div class="front-page-4 widget-area"><div class="wrap">',
			'after'  => '</div></div>',
		) );
	} );

	add_filter( 'body_class', 'startup_front_page_body_class' );
	/**
	 * Add front page body class.
	 *
	 * @since 1.1.0
	 *
	 * @param array $classes Array of body classes.
	 *
	 * @return array
	 */
	function startup_front_page_body_class( $classes ) {
		$classes[] = 'front-page';
		$classes   = array_diff( $classes, [ 'blog', 'is-archive' ] );

		return $classes;
	}

} else if ( 'page' === get_option( 'show_on_front' ) ) {
	add_filter( 'body_class', 'startup_front_page_body_class' );
	/**
	 * Add front page body class.
	 *
	 * @since 1.1.0
	 *
	 * @param array $classes Array of body classes.
	 *
	 * @return array
	 */
	function startup_front_page_body_class( $classes ) {
		$classes[] = 'is-singular';

		return $classes;
	}
}

// Remove default hero section.
if ( 'page' === get_option( 'show_on_front' ) && is_active_sidebar( 'front-page-1' ) ) {
	remove_action( 'genesis_meta', 'startup_hero_section_setup' );
}

// Run Genesis.
genesis();
