<?php
/**
 * Startup Pro
 *
 * This file contains the hero section functionality for the child theme.
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

add_action( 'genesis_meta', 'startup_hero_section_setup' );
/**
 * Sets up hero section.
 *
 * @since  1.5.0
 *
 * @return void
 */
function startup_hero_section_setup() {
	if ( is_admin() ) {
		return;
	}

	if ( is_singular( 'page' ) && ! is_page_template( 'page_blog.php' ) || is_attachment() ) {
		remove_action( 'genesis_entry_header', 'genesis_do_post_title' );
	}

	remove_action( 'genesis_entry_header', 'genesis_entry_header_markup_open', 5 );
	remove_action( 'genesis_entry_header', 'genesis_entry_header_markup_close', 15 );
	remove_action( 'genesis_before_loop', 'genesis_do_posts_page_heading' );
	remove_action( 'genesis_archive_title_descriptions', 'genesis_do_archive_headings_open', 5, 3 );
	remove_action( 'genesis_archive_title_descriptions', 'genesis_do_archive_headings_close', 15, 3 );
	remove_action( 'genesis_before_loop', 'genesis_do_date_archive_title' );
	remove_action( 'genesis_before_loop', 'genesis_do_blog_template_heading' );
	remove_action( 'genesis_before_loop', 'genesis_do_taxonomy_title_description', 15 );
	remove_action( 'genesis_before_loop', 'genesis_do_author_title_description', 15 );
	remove_action( 'genesis_before_loop', 'genesis_do_cpt_archive_title_description' );
	remove_action( 'genesis_before_loop', 'genesis_do_search_title' );
	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );
	remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );

	add_filter( 'woocommerce_show_page_title', '__return_null' );
	add_filter( 'genesis_search_title_output', '__return_false' );
	add_filter( 'genesis_attr_hero-section', 'startup_hero_section_attributes' );
	add_filter( 'genesis_attr_hero-title', 'startup_hero_section_title_attributes' );
	add_filter( 'genesis_attr_entry', 'startup_hero_section_entry_attributes' );

	add_action( 'startup_pro_hero_section', 'genesis_do_posts_page_heading' );
	add_action( 'startup_pro_hero_section', 'genesis_do_date_archive_title' );
	add_action( 'startup_pro_hero_section', 'genesis_do_taxonomy_title_description' );
	add_action( 'startup_pro_hero_section', 'genesis_do_author_title_description' );
	add_action( 'startup_pro_hero_section', 'genesis_do_cpt_archive_title_description' );
	add_action( 'startup_pro_hero_section', 'startup_hero_section_title', 10 );
	add_action( 'startup_pro_hero_section', 'startup_hero_section_excerpt', 20 );
	add_action( 'be_title_toggle_remove', 'startup_hero_section_title_toggle' );
	add_action( 'genesis_before_content', 'startup_hero_section_remove_404_title' );
	add_action( 'genesis_before_content_sidebar_wrap', 'startup_hero_section_display' );
}

/**
 * Remove default title of 404 pages.
 *
 * @since  1.1.0
 *
 * @return void
 */
function startup_hero_section_remove_404_title() {
	if ( is_404() ) {
		add_filter( 'genesis_markup_entry-title_open', '__return_false' );
		add_filter( 'genesis_markup_entry-title_content', '__return_false' );
		add_filter( 'genesis_markup_entry-title_close', '__return_false' );
	}
}

/**
 * Integrate with Genesis Title Toggle plugin.
 *
 * @since  1.1.0
 *
 * @author Bill Erickson
 * @link   http://billerickson.net/code/genesis-title-toggle-theme-integration
 *
 * @return void
 */
function startup_hero_section_title_toggle() {
	remove_action( 'startup_pro_hero_section', 'startup_hero_section_title', 10 );
	remove_action( 'startup_pro_hero_section', 'startup_hero_section_excerpt', 20 );
}

/**
 * Display title in hero section.
 *
 * @since  1.1.0
 *
 * @return void
 */
function startup_hero_section_title() {
	$title = '';

	if ( class_exists( 'WooCommerce' ) && is_shop() ) {
		$title = get_the_title( wc_get_page_id( 'shop' ) );

	} elseif ( is_home() && 'posts' === get_option( 'show_on_front' ) ) {
		$id    = get_page_by_path( 'home' );
		$title = $id ? get_the_title( $id ) : __( 'Latest Posts', 'startup-pro' );
		$title = apply_filters( 'startup_pro_latest_posts_title', esc_html( $title ) );

	} elseif ( is_404() ) {
		$id    = get_page_by_path( 'error' );
		$title = $id ? get_the_title( $id ) : __( 'Not found, error 404', 'startup-pro' );
		$title = apply_filters( 'genesis_404_entry_title', esc_html( $title ) );

	} elseif ( is_search() ) {
		$title = apply_filters( 'genesis_search_title_text', esc_html( 'Search results for: ' ) . get_search_query() );

	} elseif ( is_singular( [ 'page', 'product' ] ) || is_attachment() ) {
		$title = apply_filters( 'genesis_post_title_text', get_the_title() );

	}

	if ( $title ) {
		genesis_markup( [
			'open'    => '<h1 %s>',
			'close'   => '</h1>',
			'content' => $title,
			'context' => 'hero-title',
		] );
	}
}

/**
 * Display page excerpt.
 *
 * @since  1.1.0
 *
 * @return void
 */
function startup_hero_section_excerpt() {
	$subtitle = '';

	if ( class_exists( 'WooCommerce' ) && is_shop() ) {
		ob_start();
		woocommerce_result_count();
		$subtitle = ob_get_clean();

	} elseif ( is_home() && 'posts' === get_option( 'show_on_front' ) ) {
		$id       = get_page_by_path( 'home' );
		$excerpt  = has_excerpt( $id ) ? get_the_excerpt( $id ) : __( 'Showing the latest posts', 'startup-pro' );
		$subtitle = apply_filters( 'startup_pro_latest_posts_excerpt', $excerpt );

	} elseif ( is_home() ) {
		$id       = get_option( 'page_for_posts' );
		$subtitle = has_excerpt( $id ) ? get_the_excerpt( $id ) : '';

	} elseif ( is_search() ) {
		$id       = get_page_by_path( 'search' );
		$subtitle = has_excerpt( $id ) ? get_the_excerpt( $id ) : '';

	} elseif ( is_404() ) {
		$id       = get_page_by_path( 'error' );
		$subtitle = has_excerpt( $id ) ? get_the_excerpt( $id ) : '';

	} elseif ( is_singular( 'product' ) ) {
		ob_start();
		woocommerce_template_single_excerpt();
		$subtitle = ob_get_clean();

	} elseif ( ( is_singular() ) ) {
		$subtitle = has_excerpt() ? get_the_excerpt() : '';

	}

	if ( $subtitle ) {
		printf( '<p class="hero-subtitle" itemprop="description">%s</p>', do_shortcode( $subtitle ) );
	}
}

/**
 * Display the hero section.
 *
 * @since  1.1.0
 *
 * @return void
 */
function startup_hero_section_display() {
	$background = has_custom_header() && true === get_theme_mod( 'single_page_hero_background', false ) ? '<div class="hero-background"></div>' : '';

	genesis_markup( [
		'open'    => '<section %s>' . $background . '<div class="wrap">',
		'context' => 'hero-section',
	] );

	do_action( 'startup_pro_hero_section' );

	genesis_markup( [
		'close'   => '</div></section>',
		'context' => 'hero-section',
	] );
}

/**
 * Entry itemref attributes.
 *
 * @since 1.1.0
 *
 * @return array
 */
function startup_hero_section_entry_attributes( $atts ) {
	if ( is_singular() && ! is_page_template( 'page_blog.php' ) ) {
		$atts['itemref'] = 'hero-section';
	}

	return $atts;
}

/**
 * Hero section attributes.
 *
 * @since 1.1.0
 *
 * @return array
 */
function startup_hero_section_attributes( $atts ) {
	$atts['id']   = 'hero-section';
	$atts['role'] = 'banner';

	return $atts;
}

/**
 * Hero title attributes.
 *
 * @since 1.1.3
 *
 * @return array
 */
function startup_hero_section_title_attributes( $atts ) {
	$atts['itemprop'] = 'headline';

	return $atts;
}