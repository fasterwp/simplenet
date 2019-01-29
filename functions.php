<?php
/**
 * Startup Pro
 *
 * This file contains the default functions for the child theme.
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

// Define theme constants (do not remove).
$startup_pro = wp_get_theme();
define( 'CHILD_THEME_NAME', $startup_pro->get( 'Name' ) );
define( 'CHILD_THEME_URL', $startup_pro->get( 'ThemeURI' ) );
define( 'CHILD_THEME_VERSION', $startup_pro->get( 'Version' ) );
define( 'CHILD_THEME_HANDLE', $startup_pro->get( 'TextDomain' ) );
define( 'CHILD_THEME_DIR', get_stylesheet_directory() );
define( 'CHILD_THEME_URI', get_stylesheet_directory_uri() );

// Load Genesis Framework (do not remove).
require_once get_template_directory() . '/lib/init.php';

// Load Startup Pro Theme (do not remove).
require_once CHILD_THEME_DIR . '/includes/setup.php';
require_once CHILD_THEME_DIR . '/includes/helpers.php';
require_once CHILD_THEME_DIR . '/includes/general.php';
require_once CHILD_THEME_DIR . '/includes/enqueue.php';
require_once CHILD_THEME_DIR . '/includes/hero.php';
require_once CHILD_THEME_DIR . '/includes/kirki.php';
require_once CHILD_THEME_DIR . '/includes/widgets.php';
require_once CHILD_THEME_DIR . '/includes/plugins.php';
require_once CHILD_THEME_DIR . '/includes/defaults.php';
