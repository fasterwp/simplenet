<?php
/**
 * Startup Pro
 *
 * This file contains the setup functions for the child theme.
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

// Set Localization (do not remove).
load_child_theme_textdomain( 'startup-pro', apply_filters( 'child_theme_textdomain', CHILD_THEME_DIR . '/assets/languages', 'startup-pro' ) );

// Add support for alignwide classes.
add_theme_support( 'align-wide' );

// Add support for automatic feed links.
add_theme_support( 'automatic-feed-links' );

// Add support for custom logo.
add_theme_support( 'custom-logo', [
	'height'      => 100,
	'width'       => 300,
	'flex-height' => true,
	'flex-width'  => true,
	'header-text' => [
		'.site-title',
		'.site-description',
	],
] );

// Add support for custom header.
add_theme_support( 'custom-header', [
	'header-selector'  => '.hero-background',
	'default_image'    => CHILD_THEME_URI . '/assets/images/hero.jpg',
	'header-text'      => false,
	'width'            => 1280,
	'height'           => 720,
	'flex-height'      => true,
	'flex-width'       => true,
	'uploads'          => true,
	'video'            => true,
	'wp-head-callback' => 'startup_custom_header',
] );

// Add support for accessibility features.
add_theme_support( 'genesis-accessibility', [
	'404-page',
	'drop-down-menu',
	'headings',
	'rems',
	'search-form',
	'skip-links',
] );

// Add support for after entry widget area.
add_theme_support( 'genesis-after-entry-widget-area' );

// Add support for footer widgets.
add_theme_support( 'genesis-footer-widgets', 4 );

// Add support for navigation menus.
add_theme_support( 'genesis-menus', [
	'primary'   => __( 'Header Menu', 'startup-pro' ),
	'secondary' => __( 'After Header Menu', 'startup-pro' ),
] );

// Add support for responsive viewport tag.
add_theme_support( 'genesis-responsive-viewport' );

// Add structural wraps.
add_theme_support( 'genesis-structural-wraps', [
	'header',
	'menu-secondary',
	'footer-widgets',
	'footer',
] );

// Add support for wide images.
add_theme_support( 'gutenberg', [
	'wide-images' => true,
] );

// Add HTML5 support.
add_theme_support( 'html5', [
	'caption',
	'comment-form',
	'comment-list',
	'gallery',
	'search-form',
] );

// Add support for post thumbnails
add_theme_support( 'post-thumbnails' );

// Add support for WooCommerce features.
add_theme_support( 'woocommerce' );
add_theme_support( 'wc-product-gallery-zoom' );
add_theme_support( 'wc-product-gallery-lightbox' );
add_theme_support( 'wc-product-gallery-slider' );
add_theme_support( 'wp-block-styles' );

// Add support for page excerpts.
add_post_type_support( 'page', 'excerpt' );

// Add custom image sizes.
add_image_size( 'featured', 620, 380, true );
add_image_size( 'hero', 1280, 720, true );

// Add search form shortcode.
add_shortcode( 'search_form', function () {
	return get_search_form( false );
} );

// Register default headers.
register_default_headers( [
	'child' => [
		'url'           => '%2$s/assets/images/hero.jpg',
		'thumbnail_url' => '%2$s/assets/images/hero.jpg',
		'description'   => __( 'Hero Section Image', 'startup-pro' ),
	],
] );

// Register custom layout.
genesis_register_layout( 'center-content', array(
	'label' => __( 'Center Content', 'business-pro-theme' ),
	'img'   => CHILD_THEME_URI . '/assets/images/center-content.gif',
) );

// Unregister default layouts.
genesis_unregister_layout( 'content-sidebar-sidebar' );
genesis_unregister_layout( 'sidebar-content-sidebar' );
genesis_unregister_layout( 'sidebar-sidebar-content' );

// Remove secondary sidebar.
unregister_sidebar( 'sidebar-alt' );

// Display the custom logo.
add_action( 'genesis_site_title', 'the_custom_logo', 0 );

// Remove Genesis Simple FAQ styles.
add_filter( 'gs_faq_print_styles', '__return_false' );

// Remove Simple Pricing Table inline CSS.
add_filter( 'spt_inline_css', '__return_false' );

// Remove WooCommerce product description heading.
add_filter( 'woocommerce_product_description_heading', '__return_empty_string' );

// Change priority of child theme stylesheet.
remove_action( 'genesis_meta', 'genesis_load_stylesheet' );
add_action( 'wp_enqueue_scripts', 'genesis_enqueue_main_stylesheet', 99 );

// Reposition primary navigation menu.
remove_action( 'genesis_after_header', 'genesis_do_nav' );
add_action( 'child_theme_after_title_area', 'genesis_do_nav' );

// Reposition primary navigation menu.
remove_action( 'genesis_after_header', 'genesis_do_subnav' );
add_action( 'child_theme_after_header_wrap', 'genesis_do_subnav' );

// Reposition footer widget areas.
remove_action( 'genesis_before_footer', 'genesis_footer_widget_areas' );
add_action( 'child_theme_before_footer_wrap', 'genesis_footer_widget_areas', 15 );

// Reposition post featured image.
remove_action( 'genesis_entry_content', 'genesis_do_post_image', 8 );
add_action( 'genesis_entry_header', 'genesis_do_post_image', 0 );
