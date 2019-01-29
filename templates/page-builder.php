<?php
/**
 * Startup Pro
 *
 * Template Name: Page Builder
 *
 * @package   SeoThemes\StartupPro
 * @link      https://seothemes.com/startup-pro
 * @author    SEO Themes
 * @copyright Copyright © 2018 SEO Themes
 * @license   GPL-3.0-or-later
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

// Get site-header.
get_header();

// Custom loop, remove all hooks except entry content.
if ( have_posts() ) :
	the_post();
	do_action( 'genesis_entry_content' );
endif;

// Get site-footer.
get_footer();
