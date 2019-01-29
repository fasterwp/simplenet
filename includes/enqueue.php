<?php
/**
 * Startup Pro
 *
 * This file enqueues the scripts and styles for the child theme.
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

add_action( 'wp_enqueue_scripts', 'startup_enqueue_scripts_styles' );
/**
 * Enqueue Scripts and Styles.
 *
 * @since 1.1.0
 *
 * @return void
 */
function startup_enqueue_scripts_styles() {

	// Load Google Fonts.
	wp_enqueue_style( CHILD_THEME_HANDLE . '-google-fonts', '//fonts.googleapis.com/css?family=Source+Sans+Pro:400,400i,700,700i', array(), CHILD_THEME_VERSION );

	// Load WooCommerce styles.
	if ( class_exists( 'WooCommerce' ) ) {
		wp_enqueue_style( CHILD_THEME_HANDLE . '-woocommerce', CHILD_THEME_URI . '/woocommerce.css', array(), CHILD_THEME_VERSION );
	}

	// Load EDD styles.
	if ( class_exists( 'Easy_Digital_Downloads' ) ) {
		wp_enqueue_style( CHILD_THEME_HANDLE . '-easydigitaldownloads', CHILD_THEME_URI . '/edd.css', array(), CHILD_THEME_VERSION );
	}

	// Load Gravity Forms styles.
	if ( class_exists( 'GFCommon' ) ) {
		wp_enqueue_style( CHILD_THEME_HANDLE . '-gravityforms', CHILD_THEME_URI . '/gravityforms.css', array(), CHILD_THEME_VERSION );
	}

	// Load custom scripts.
	wp_enqueue_script( CHILD_THEME_HANDLE . '-fitvids', CHILD_THEME_URI . '/assets/scripts/jquery.fitvids.js', array( 'jquery' ), CHILD_THEME_VERSION, true );

	// Load custom scripts.
	wp_enqueue_script( CHILD_THEME_HANDLE, CHILD_THEME_URI . '/assets/scripts/script.js', array(
		'jquery',
		CHILD_THEME_HANDLE . '-fitvids'
	), CHILD_THEME_VERSION, true );

	// Load responsive menu script.
	wp_enqueue_script( CHILD_THEME_HANDLE . '-menus', CHILD_THEME_URI . '/assets/scripts/menus.js', array( 'jquery' ), CHILD_THEME_VERSION, true );

	// Localize responsive menu script.
	wp_localize_script( CHILD_THEME_HANDLE . '-menus', 'genesis_responsive_menu', array(
		'mainMenu'         => '<span class="hamburger"></span><span class="screen-reader-text">' . __( 'Menu', 'startup-pro' ) . '</span>',
		'subMenu'          => __( 'Sub Menu', 'startup-pro' ),
		'menuIconClass'    => null,
		'subMenuIconClass' => null,
		'menuClasses'      => [
			'combine' => [
				'.nav-primary',
				'.nav-secondary',
			],
		],
	) );

	// Remove default superfish args.
	wp_deregister_script( 'superfish-args' );
	wp_dequeue_script( 'superfish-args' );
}

add_action( 'enqueue_block_editor_assets', 'startup_gutenberg_admin_styles' );
/**
 * Load Gutenberg admin styles.
 *
 * @since 1.1.0
 *
 * @return void
 */
function startup_gutenberg_admin_styles() {

	// Load custom Gutenberg styles.
	wp_enqueue_style( CHILD_THEME_HANDLE . '-gutenberg-editor', get_stylesheet_directory_uri() . '/gutenberg-editor.css' );

	// Load custom Google Fonts.
//	wp_enqueue_style( CHILD_THEME_HANDLE . '-gutenberg-google-fonts', '//fonts.googleapis.com/css?family=Rubik%3A400%2C400i%2C700%2C700i' );
}
