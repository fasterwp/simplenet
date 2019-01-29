<?php
/**
 * Startup Pro
 *
 * This file contains the widget areas for the child theme.
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

// Register Front Page 1 widget area.
genesis_register_sidebar( [
	'id'           => 'front-page-1',
	'name'         => __( 'Front Page 1', 'startup-pro' ),
	'description'  => __( 'This the the Front Page 1 widget area.', 'startup-pro' ),
	'before_title' => '<h1 itemprop="headline">',
	'after_title'  => '</h1>',
] );

// Register Front Page 2 widget area.
genesis_register_sidebar( [
	'id'          => 'front-page-2',
	'name'        => __( 'Front Page 2', 'startup-pro' ),
	'description' => __( 'This the the Front Page 2 widget area.', 'startup-pro' ),
] );

// Register Front Page 3 widget area.
genesis_register_sidebar( [
	'id'          => 'front-page-3',
	'name'        => __( 'Front Page 3', 'startup-pro' ),
	'description' => __( 'This the the Front Page 3 widget area.', 'startup-pro' ),
] );

// Register Front Page 4 widget area.
genesis_register_sidebar( [
	'id'          => 'front-page-4',
	'name'        => __( 'Front Page 4', 'startup-pro' ),
	'description' => __( 'This the the Front Page 4 widget area.', 'startup-pro' ),
] );

// Register Before Footer widget area.
genesis_register_sidebar( [
	'id'          => 'before-footer',
	'name'        => __( 'Before Footer', 'startup-pro' ),
	'description' => __( 'This is the Before Footer widget area', 'startup-pro' ),
] );

// Register Footer Credits widget area.
genesis_register_sidebar( [
	'id'          => 'footer-credits',
	'name'        => __( 'Footer Credits', 'startup-pro' ),
	'description' => __( 'This is the Footer Credits widget area', 'startup-pro' ),
] );

add_action( 'child_theme_before_footer_wrap', 'startup_before_footer_widget_area' );
/**
 * Display the Before Footer widget area.
 *
 * @since 1.1.0
 *
 * @return void
 */
function startup_before_footer_widget_area() {
	genesis_widget_area( 'before-footer', array(
		'before' => '<div class="before-footer widget-area"><div class="wrap">',
		'after'  => '</div></div>',
	) );
}

add_action( 'genesis_footer_creds_text', 'startup_footer_credits_widget_area' );
/**
 * Display the Footer Credits widget area.
 *
 * @since 1.1.0
 *
 * @return void
 */
function startup_footer_credits_widget_area() {
	genesis_widget_area( 'footer-credits', array(
		'before' => '',
		'after'  => '',
	) );
}
