<?php
/**
 * Startup Pro
 *
 * This file contains the default settings for the child theme.
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

add_filter( 'genesis_theme_settings_defaults', 'startup_theme_defaults' );
/**
 * Set default theme settings.
 *
 * @since 1.1.0
 *
 * @param array $defaults Default theme settings.
 *
 * @return array
 */
function startup_theme_defaults( $defaults ) {
	$defaults['blog_cat_num']              = 6;
	$defaults['content_archive']           = 'full';
	$defaults['content_archive_limit']     = 300;
	$defaults['content_archive_thumbnail'] = 1;
	$defaults['image_alignment']           = 'alignnone';
	$defaults['posts_nav']                 = 'numeric';
	$defaults['image_size']                = 'featured';
	$defaults['site_layout']               = 'center-content';

	return $defaults;
}

add_action( 'after_switch_theme', 'startup_theme_setting_defaults' );
/**
 * Update Theme Settings upon activation.
 *
 * @since 2.0.0
 *
 * @return void
 */
function startup_theme_setting_defaults() {
	if ( function_exists( 'genesis_update_settings' ) ) {
		genesis_update_settings( array(
			'blog_cat_num'              => 6,
			'content_archive'           => 'full',
			'content_archive_limit'     => 300,
			'content_archive_thumbnail' => 1,
			'image_alignment'           => 'alignnone',
			'image_size'                => 'featured',
			'posts_nav'                 => 'numeric',
			'site_layout'               => 'center-content',
		) );
	}
	update_option( 'posts_per_page', 6 );
}

add_filter( 'simple_social_default_styles', 'startup_social_default_styles' );
/**
 * Set Simple Social Icon Defaults.
 *
 * @since 1.1.0
 *
 * @param array $defaults Default SSI settings.
 *
 * @return array
 */
function startup_social_default_styles( $defaults ) {
	$args = array(
		'new_window'             => 1,
		'size'                   => 40,
		'background_color'       => '',
		'background_color_hover' => '',
		'icon_color_hover'       => '#7448ff',
		'icon_color'             => '#a7b8c5',
		'border_radius'          => 5,
	);
	$args = wp_parse_args( $args, $defaults );

	return $args;
}

add_filter( 'icon_widget_defaults', 'startup_icon_widget_defaults' );
/**
 * Set Icon Widget defaults.
 *
 * @since 1.1.0
 *
 * @param array $defaults Default settings.
 *
 * @return array
 */
function startup_icon_widget_defaults( $defaults ) {
	$defaults['align']   = 'center';
	$defaults['color']   = '#ffffff';
	$defaults['bg']      = '#7d44ff';
	$defaults['padding'] = '12';
	$defaults['radius']  = '20';

	return $defaults;
}

add_filter( 'icon_widget_default_font', 'startup_icon_widget_default_font' );
/**
 * Set Icon Widget defaults.
 *
 * @since 1.1.0
 *
 * @return string
 */
function startup_icon_widget_default_font() {
	return 'ionicons';
}
