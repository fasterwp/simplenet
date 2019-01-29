<?php
/**
 * Startup Pro
 *
 * This file contains the general functionality of the child theme.
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

add_filter( 'body_class', 'startup_body_class' );
/**
 * Add custom contextual body classes.
 *
 * @since 1.1.0
 *
 * @param array $classes Array of body classes.
 *
 * @return array
 */
function startup_body_class( $classes ) {
	global $post;

	if ( ! is_front_page() && is_home() || is_search() || is_author() || is_date() || is_category() || is_tag() || is_page_template( 'page_blog.php' ) || is_post_type_archive() || ( is_home() && 'posts' === get_option( 'show_on_front' ) ) ) {
		$classes[] = 'is-archive';
	}

	if ( ! is_front_page() && ! is_page_template( 'page_blog.php' ) && ! is_post_type_archive() && is_singular() || is_404() ) {
		$classes[] = 'is-singular';
	}

	if ( is_page_template( 'page-blog.php' ) ) {
		$classes[] = 'blog';
		$classes   = array_diff( $classes, [ 'page' ] );
	}

	if ( $post && has_post_thumbnail( $post->ID ) && get_theme_mod( 'single_post_featured_image', false ) ) {
		$classes[] = 'has-featured-image';
	} else {
		$classes[] = 'has-no-featured-image';
	}

	if ( $post && $post->post_excerpt && strpos( $post->post_excerpt, 'mockup-' ) ) {
		$classes[] = 'has-excerpt-shortcode';
		$classes[] = 'has-hero-section-mockup';
	}

	if ( $post && has_shortcode( $post->post_excerpt, 'gs_faq' ) ) {
		$classes[] = 'has-excerpt-shortcode';
	}

	if ( $post && has_shortcode( $post->post_excerpt, 'ank_google_map' ) ) {
		$classes[] = 'has-excerpt-shortcode';
	}

	if ( $post && has_shortcode( $post->post_excerpt, 'pricing_table' ) ) {
		$classes[] = 'has-excerpt-shortcode';
	}

	if ( $post && ! is_search() && ( has_shortcode( $post->post_content, 'downloads' ) || has_shortcode( $post->post_content, 'products' ) ) ) {
		$classes[] = 'has-content-shortcode';
	}

	if ( get_theme_mod( 'startup_show_description', false ) ) {
		$classes[] = 'has-site-description';
	}

	if ( get_theme_mod( 'startup_front_page_1_video_style', 'browser' ) === 'browser' ) {
		$classes[] = 'has-browser-video-style';
	}

	$classes[] = 'has-' . get_theme_mod( 'startup_hero_divider', 'curve' ) . '-divider';

	$classes[] = 'has-' . get_theme_mod( 'startup_hero_search_style', 'light' ) . '-hero-search-style';

	$classes[] = 'no-js';

	return $classes;
}

add_filter( 'genesis_site_layout', 'startup_custom_page_layouts' );
/**
 * Enable user to select layouts for search and 404 pages.
 *
 * @since 1.1.0
 *
 * @param string $layout Default page layout.
 *
 * @return bool|mixed|string
 */
function startup_custom_page_layouts( $layout ) {
	if ( is_home() && 'posts' === get_option( 'show_on_front' ) ) {
		$page = get_page_by_path( 'home' );

		if ( $page ) {
			$field  = genesis_get_custom_field( '_genesis_layout', $page->ID );
			$layout = $field ? $field : genesis_get_option( 'site_layout' );
		}
	}

	if ( is_search() ) {
		$page = get_page_by_path( 'search' );

		if ( $page ) {
			$field  = genesis_get_custom_field( '_genesis_layout', $page->ID );
			$layout = $field ? $field : genesis_get_option( 'site_layout' );
		}
	}

	if ( is_404() ) {
		$page = get_page_by_path( 'error404' );

		if ( $page ) {
			$field  = genesis_get_custom_field( '_genesis_layout', $page->ID );
			$layout = $field ? $field : genesis_get_option( 'site_layout' );
		}
	}

	return $layout;
}

add_action( 'genesis_before', 'startup_genesis_simple_faq_js' );
/**
 * Load Genesis Simple FAQ scripts for shortcodes.
 *
 * @since 1.1.0
 *
 * @return void
 */
function startup_genesis_simple_faq_js() {
	global $post;

	if ( $post && has_shortcode( $post->post_excerpt, 'gs_faq' ) && ! wp_script_is( 'gs-faq-jquery-js' ) && ! wp_script_is( 'gs-faq-vanilla-js' ) ) {
		Genesis_Simple_FAQ()->assets->enqueue_scripts();
	}
}

add_action( 'genesis_before', 'startup_js_nojs_script' );
/**
 * Add JS or No JS class to body.
 *
 * @since 1.1.0
 *
 * @return void
 */
function startup_js_nojs_script() {
	?>
    <script>
        //<![CDATA[
        (function () {
            var c = document.body.classList;
            c.remove('no-js');
            c.add('js');
        })();
        //]]>
    </script>
	<?php
}

add_filter( 'genesis_markup_title-area_close', 'startup_title_area_hook' );
/**
 * Add action hook after title area.
 *
 * @since 1.1.0
 *
 * @param string $close_html Closing title area markup.
 *
 * @return string
 */
function startup_title_area_hook( $close_html ) {
	if ( $close_html ) {
		ob_start();
		do_action( 'child_theme_after_title_area' );
		$close_html = $close_html . ob_get_clean();
	}

	return $close_html;
}

add_action( 'genesis_before', 'startup_structural_wrap_hooks' );
/**
 * Add action hooks before and after structural wraps.
 *
 * @since 1.1.0
 *
 * @return void
 */
function startup_structural_wrap_hooks() {
	$wraps = get_theme_support( 'genesis-structural-wraps' );

	foreach ( $wraps[0] as $context ) {
		add_filter( "genesis_structural_wrap-{$context}", function ( $output, $original ) use ( $context ) {
			$position = ( 'open' === $original ) ? 'before' : 'after';
			ob_start();
			do_action( "child_theme_{$position}_{$context}_wrap" );
			if ( 'open' === $original ) {
				return ob_get_clean() . $output;

			} else {
				return $output . ob_get_clean();
			}
		}, 10, 2 );
	}
}

add_filter( 'genesis_attr_content-sidebar-wrap', 'startup_content_sidebar_wrap' );
/**
 * Rename content-sidebar-wrap to just wrap.
 *
 * @since 1.1.0
 *
 * @param array $atts Content sidebar wrap attributes.
 *
 * @return mixed
 */
function startup_content_sidebar_wrap( $atts ) {
	$atts['class'] = 'wrap';

	return $atts;
}

add_filter( 'genesis_structural_wrap-footer', 'startup_footer_wrap', 10, 2 );
/**
 * Modify the footer wrapper.
 *
 * @since 1.1.0
 *
 * @param string $output
 * @param string $original_output
 *
 * @return string
 */
function startup_footer_wrap( $output, $original_output ) {
	if ( 'open' == $original_output ) {
		$output = '<div class="footer-credits">' . $output;
	} elseif ( 'close' == $original_output ) {
		$output = $output . $output;
	}

	return $output;
}

add_action( 'genesis_before', 'startup_center_content_layout' );
/**
 * Remove sidebars for custom layout.
 *
 * @since 1.1.0
 *
 * @return void
 */
function startup_center_content_layout() {
	if ( 'center-content' === genesis_site_layout() ) {
		add_filter( 'genesis_site_layout', '__genesis_return_full_width_content' );
	}
}

add_action( 'genesis_entry_header', 'startup_single_post_image', 0 );
/**
 * Display featured image on single posts.
 *
 * @since 1.1.0
 *
 * @return void
 */
function startup_single_post_image() {
	if ( is_singular( [
			'post',
			'portfolio',
			'download'
		] ) && get_theme_mod( 'single_post_featured_image', true ) && has_post_thumbnail() ) {
		printf( "<p class='entry-image'>%s</p>", genesis_get_image( [
			'size' => 'hero',
		] ) );
	}
}

add_filter( 'genesis_widget_column_classes', 'startup_widget_column_classes' );
/**
 * Add custom widget column classes.
 *
 * @since 1.1.0
 *
 * @param array $column_classes Default column classes.
 *
 * @return array
 */
function startup_widget_column_classes( $column_classes ) {
	$column_classes[] = 'one-fifth';
	$column_classes[] = 'two-fifths';
	$column_classes[] = 'three-fifths';
	$column_classes[] = 'four-fifths';
	$column_classes[] = 'full-width';

	return $column_classes;
}

add_filter( 'get_the_content_more_link', 'startup_read_more_link' );
/**
 * Modify the read more link.
 *
 * @since 1.0.0
 *
 * @return string
 */
function startup_read_more_link() {
	return sprintf( '<span class="ellipses">&hellip;</span> <a href="%s" class="more-link">%s</a>',
		get_the_permalink(),
		genesis_a11y_more_link( __( 'Read More', 'startup-pro' ) )
	);
}

add_filter( 'genesis_post_info', 'startup_post_info_date' );
/**
 * Modify the post info date.
 *
 * @since 1.1.0
 *
 * @param string $post_info Default post info.
 *
 * @return false|string
 */
function startup_post_info_date( $post_info ) {
	if ( is_archive() || is_home() || is_search() || is_post_type_archive() || is_page_template( 'page_blog.php' ) ) {
		$post_info = get_the_modified_date();
	}

	return $post_info;
}

add_filter( 'genesis_post_meta', 'startup_post_meta_icons' );
/**
 * Add icons to post meta.
 *
 * @since 1.1.0
 *
 * @param $post_meta
 *
 * @return string
 */
function startup_post_meta_icons( $post_meta ) {
	if ( is_archive() || is_home() || is_search() || ! is_post_type_archive() ) {
		$cat_alt   = apply_filters( 'corporate_cat_alt', __( 'Category icon', 'startup-pro' ) );
		$tag_alt   = apply_filters( 'corporate_tag_alt', __( 'Tag icon', 'startup-pro' ) );
		$cat_img   = '<img width=\'20\' height=\'20\' alt=\'' . $cat_alt . '\' src=\'' . CHILD_THEME_URI . '/assets/images/cats.svg\'>';
		$tag_img   = '<img width=\'20\' height=\'20\' alt=\'' . $tag_alt . '\' src=\'' . CHILD_THEME_URI . '/assets/images/tags.svg\'>';
		$post_meta = '[post_categories before="' . $cat_img . '" sep=",&nbsp;"] [post_tags before="' . $tag_img . '" sep=",&nbsp;"]';
	}

	return $post_meta;
}

add_filter( 'genesis_prev_link_text', 'startup_prev_link_text' );
/**
 * Change pagination previous text.
 *
 * @since 1.1.0
 *
 * @return string
 */
function startup_prev_link_text() {
	if ( 'numeric' === genesis_get_option( 'posts_nav' ) ) {
		return '←';
	} else {
		return '← Previous';
	}
}

add_filter( 'genesis_next_link_text', 'startup_next_link_text' );
/**
 * Change pagination next text.
 *
 * @since 1.1.0
 *
 * @return string
 */
function startup_next_link_text() {
	if ( 'numeric' === genesis_get_option( 'posts_nav' ) ) {
		return '→';
	} else {
		return 'Next →';
	}
}

add_filter( 'agm_custom_styles', 'startup_google_map_styles' );
/**
 * Add custom Google Map styles.
 *
 * @since 1.1.0
 *
 * @param array $json Map style data
 *
 * @return mixed
 */
function startup_google_map_styles( $json ) {
	array_push( $json, array(
		'id'    => '123456789',
		'name'  => 'Ultra Light',
		'style' => json_decode( file_get_contents( CHILD_THEME_DIR . '/map.json' ), true ),
	) );

	return $json;
}

add_filter( 'woocommerce_output_related_products_args', 'startup_woocommerce_related_products' );
/**
 * Modify the related products section.
 *
 * @since 1.1.0
 *
 * @param array $args Default arguments.
 *
 * @return mixed
 */
function startup_woocommerce_related_products( $args ) {
	$args['posts_per_page'] = 3;
	$args['columns']        = 3;

	return $args;
}

add_filter( 'genesis_attr_nav-link', 'startup_nav_link_class' );
/**
 * Add class to navigation menu links.
 *
 * @since 1.1.0
 *
 * @param array $atts Default attributes.
 *
 * @return mixed
 */
function startup_nav_link_class( $atts ) {
	$atts['class'] = 'menu-item-link';

	return $atts;
}

add_action( 'genesis_before', 'startup_reposition_post_info' );
/**
 * Reposition post info on archives.
 *
 * @since 1.1.5
 *
 * @return void
 */
function startup_reposition_post_info() {
	if ( is_archive() || is_home() || is_search() || is_post_type_archive() || is_page_template( 'page_blog.php' ) ) {
		remove_action( 'genesis_entry_header', 'genesis_post_info', 12 );
		add_action( 'genesis_entry_header', 'genesis_post_info', 1 );
	}
}

add_action( 'genesis_before', 'startup_reposition_breadcrumb' );
/**
 * Reposition breadcrumbs.
 *
 * @since 1.1.5
 *
 * @return void
 */
function startup_reposition_breadcrumb() {
	remove_action( 'genesis_before_loop', 'genesis_do_breadcrumbs' );

    if ( is_singular() ) {
	    global $post;

	    if ( $post && ! is_search() && ( has_shortcode( $post->post_content, 'downloads' ) || has_shortcode( $post->post_content, 'products' ) ) ) {
		    add_action( 'startup_pro_hero_section', 'genesis_do_breadcrumbs', 30 );

	    } else {
		    add_action( 'genesis_entry_header', 'genesis_do_breadcrumbs' );
        }

    } else {
	    add_action( 'startup_pro_hero_section', 'genesis_do_breadcrumbs', 30 );
    }
}
