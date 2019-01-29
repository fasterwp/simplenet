<?php
/**
 * Startup Pro
 *
 * This file contains the helper functions for the child theme.
 *
 * @package   SeoThemes\StartupPro
 * @link      https://seothemes.com/startup-pro
 * @author    SEO Themes
 * @copyright Copyright © 2018 SEO Themes
 * @license   GPL-3.0-or-later
 */

// If this file is called directly, abort..
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Custom header image callback.
 *
 * @since  1.1.3
 *
 * @return string
 */
function startup_custom_header() {
	$id = '';

	if ( class_exists( 'WooCommerce' ) && is_shop() ) {
		$id = wc_get_page_id( 'shop' );

	} elseif ( is_post_type_archive() ) {
		$id = get_page_by_path( get_query_var( 'post_type' ) );
		$id = $id->ID && has_post_thumbnail( $id->ID ) ? $id->ID : false;

	} elseif ( is_category() ) {
		$id = get_page_by_title( 'category-' . get_query_var( 'category_name' ), OBJECT, 'attachment' );

	} elseif ( is_tag() ) {
		$id = get_page_by_title( 'tag-' . get_query_var( 'tag' ), OBJECT, 'attachment' );

	} elseif ( is_tax() ) {
		$id = get_page_by_title( 'term-' . get_query_var( 'term' ), OBJECT, 'attachment' );

	} elseif ( is_front_page() ) {
		$id = get_option( 'page_on_front' );

	} elseif ( is_home() ) {
		$id = get_option( 'page_for_posts' );

	} elseif ( is_search() ) {
		$id = get_page_by_path( 'search' )->ID;

	} elseif ( is_404() ) {
		$id = get_page_by_path( 'error' )->ID;

	} elseif ( is_singular() ) {
		$id = get_the_id();

	}

	if ( is_object( $id ) ) {
		$url = wp_get_attachment_image_url( $id->ID, 'hero' );

	} elseif ( $id ) {
		$url = get_the_post_thumbnail_url( $id, 'hero' );
	}

	if ( ! $url && get_theme_mod( 'single_page_hero_fallback', false ) ) {
		$url = get_header_image();
	}

	if ( $url ) {
		$selector = get_theme_support( 'custom-header', 'header-selector' );

		return printf( '<style id="hero-css" type="text/css">' . esc_attr( $selector ) . '{background-image:url(%s)}</style>' . "\n", esc_url( $url ) );
	} else {
		return '';
	}
}
