<?php
/**
 * Startup Pro
 *
 * This file contains the recommended plugins for the child theme.
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

require_once __DIR__ . '/tgmpa.php';

add_action( 'tgmpa_register', 'startup_register_required_plugins' );
/**
 * Define recommended plugins.
 *
 * @since 1.1.0
 *
 * @return void
 */
function startup_register_required_plugins() {
	$plugins = [
		[
			'name'     => 'Genesis eNews Extended',
			'slug'     => 'genesis-enews-extended',
			'required' => false,
		],
		[
			'name'     => 'Genesis Simple FAQ',
			'slug'     => 'genesis-simple-faq',
			'required' => false,
		],
		[
			'name'     => 'Genesis Testimonial Slider',
			'slug'     => 'wpstudio-testimonial-slider',
			'required' => false,
		],
		[
			'name'     => 'Genesis Widget Column Classes',
			'slug'     => 'genesis-widget-column-classes',
			'required' => false,
		],
		[
			'name'     => 'Google Map',
			'slug'     => 'ank-google-map',
			'required' => false,
		],
		[
			'name'     => 'Icon Widget',
			'slug'     => 'icon-widget',
			'required' => false,
		],
		[
			'name'     => 'Kirki',
			'slug'     => 'kirki',
			'required' => false,
		],
		[
			'name'     => 'Simple Pricing Table',
			'slug'     => 'simple-pricing-table',
			'required' => false,
		],
		[
			'name'     => 'Simple Social Icons',
			'slug'     => 'simple-social-icons',
			'required' => false,
		],
		[
			'name'     => 'WP Featherlight',
			'slug'     => 'wp-featherlight',
			'required' => false,
		],
		[
			'name'     => 'Widget Importer & Exporter',
			'slug'     => 'widget-importer-exporter',
			'required' => false,
		],
		[
			'name'     => 'WordPress Importer',
			'slug'     => 'wordpress-importer',
			'required' => false,
		],
	];

	if ( class_exists( 'WooCommerce' ) ) {
		$plugins[] = [
			'name'     => 'Genesis Connect for WooCommerce',
			'slug'     => 'genesis-connect-woocommerce',
			'required' => false,
		];
	}

	if ( class_exists( 'Easy_Digital_Downloads' ) ) {
		$plugins[] = [
			'name'     => 'Genesis Connect for Easy Digital Downloads',
			'slug'     => 'genesis-connect-edd',
			'required' => false,
		];
	}

	$config = [
		'id'           => CHILD_THEME_HANDLE,
		'default_path' => '',
		'menu'         => 'tgmpa-install-plugins',
		'parent_slug'  => 'themes.php',
		'capability'   => 'edit_theme_options',
		'has_notices'  => true,
		'dismissable'  => true,
		'dismiss_msg'  => '',
		'is_automatic' => false,
		'message'      => '',
	];

	tgmpa( $plugins, $config );
}
