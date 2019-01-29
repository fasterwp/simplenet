<?php
/**
 * Startup Pro
 *
 * This file contains Customizer functionality for the child theme.
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

add_filter( 'kirki/dynamic_css/method', 'startup_kirki_output_method' );
/**
 * Set the Kirki CSS output method.
 *
 * @since 1.1.0
 *
 * @return string
 */
function startup_kirki_output_method() {
	return 'file';
}

add_filter( 'kirki_config', 'startup_kirki_remove_loader' );
/**
 * Removes Kirki loader image.
 *
 * @since  1.1.0
 *
 * @return array
 */
function startup_kirki_remove_loader() {
	return wp_parse_args( [
		'disable_loader' => true,
	] );
}

add_action( 'after_setup_theme', 'startup_kirki_config' );
/**
 * Adds the theme's Kirki config.
 *
 * @since  1.1.0
 *
 * @link   https://aristath.github.io/kirki/docs/getting-started/config.html
 *
 * @return void
 */
function startup_kirki_config() {
	if ( ! class_exists( 'Kirki' ) ) {
		return;
	}

	Kirki::add_config( CHILD_THEME_HANDLE, array() );
}

add_action( 'customize_register', 'startup_customizer_defaults', 99 );
/**
 * Modify default Customizer settings.
 *
 * @since  1.1.0
 *
 * @param  object $wp_customize Global customizer object.
 *
 * @return void
 */
function startup_customizer_defaults( $wp_customize ) {
	$wp_customize->remove_control( 'background_color' );
	$wp_customize->remove_control( 'header_textcolor' );
	$wp_customize->get_control( 'header_text' )->label = __( 'Display Site Title', 'startup-pro' );
}

add_action( 'after_setup_theme', 'startup_kirki_register' );
/**
 * Register panels, sections and fields.
 *
 * @since  1.1.0
 *
 * @return void
 */
function startup_kirki_register() {
	if ( ! class_exists( 'Kirki' ) ) {
		return;
	}

	Kirki::add_section( CHILD_THEME_HANDLE, [
		'title'    => __( 'Startup Pro Settings', 'startup-pro' ),
		'priority' => 150,
	]);

	$fields = require_once CHILD_THEME_DIR . '/config/kirki.php';

	foreach ( $fields as $field => $args ) {
		Kirki::add_field( CHILD_THEME_HANDLE, $args );
	}
}

add_action( 'customize_controls_print_styles', 'startup_kirki_admin_styles', 99 );
/**
 * Adds custom styles to the WordPress Customizer.
 *
 * @since  1.1.0
 *
 * @return void
 */
function startup_kirki_admin_styles() {
	?>
    <style id="startup-pro-inline-css">
        .wp-color-result .color-alpha {
            height: 22px !important;
        }

        .wp-picker-active .iris-picker {
            margin-bottom: 12px;
        }

        .customize-control-kirki-dimensions .wrapper .control > div h5 {
            margin-top: 0;
        }

        .customize-control-kirki-multicolor .wp-picker-container > .wp-color-result {
            width: auto;
            min-width: 110px;
        }

        .wp-color-result-text {
            text-align: left !important;
        }

        .tooltip-wrapper .tooltip-content {
            background: #555d66 !important;
            color: #fff !important;
        }

        .tooltip-wrapper .tooltip-content:after {
            color: #555d66 !important;
        }
    </style>
	<?php
}

add_action( 'customize_register', 'startup_kirki_installer_register', 999 );
/**
 * Registers the section, setting & control for the kirki installer.
 *
 * @since 1.1.0
 *
 * @param object $wp_customize The main customizer object.
 *
 * @return void
 */
function startup_kirki_installer_register( $wp_customize ) {

	// Early exit if Kirki exists.
	if ( class_exists( 'Kirki' ) ) {
		return;
	}

	if ( class_exists( 'WP_Customize_Section' ) && ! class_exists( 'Kirki_Installer_Section' ) ) {
		/**
		 * Recommend the installation of Kirki using a custom section.
		 *
		 * @see WP_Customize_Section
		 */
		class Kirki_Installer_Section extends WP_Customize_Section {

			/**
			 * Customize section type.
			 *
			 * @access public
			 * @var string
			 */
			public $type = 'kirki_installer';

			/**
			 * The plugin install URL.
			 *
			 * @access private
			 * @var string
			 */
			public $plugin_install_url;

			/**
			 * Render the section.
			 *
			 * @access protected
			 */
			protected function render() {

				// Don't proceed any further if the user has dismissed this.
				if ( $this->is_dismissed() ) {
					return;
				}

				// Determine if the plugin is not installed, or just inactive.
				$plugins   = get_plugins();
				$installed = false;
				foreach ( $plugins as $plugin ) {
					if ( 'Kirki' === $plugin['Name'] || 'Kirki Toolkit' === $plugin['Name'] ) {
						$installed = true;
					}
				}
				$plugin_install_url = $this->get_plugin_install_url();
				$classes            = 'cannot-expand accordion-section control-section control-section-themes control-section-' . $this->type;
				?>
                <li id="accordion-section-<?php echo esc_attr( $this->id ); ?>"
                    class="<?php echo esc_attr( $classes ); ?>"
                    style="border-top:none;border-bottom:1px solid #ddd;padding:7px 14px 21px 14px;text-align:left;">
					<?php if ( ! $installed ) : ?>
						<?php $this->install_button(); ?>
					<?php else : ?>
						<?php $this->activate_button(); ?>
					<?php endif; ?>
					<?php $this->dismiss_button(); ?>
                </li>
				<?php
			}

			/**
			 * Check if the user has chosen to hide this.
			 *
			 * @static
			 * @access public
			 * @since  1.0.0
			 * @return bool
			 */
			public static function is_dismissed() {
				// Get the user-meta.
				$user_id   = get_current_user_id();
				$user_meta = get_user_meta( $user_id, 'dismiss-kirki-recommendation', true );

				return ( true === $user_meta || '1' === $user_meta || 1 === $user_meta );
			}

			/**
			 * Adds the install button.
			 *
			 * @since 1.0.0
			 * @return void
			 */
			protected function install_button() {
				?>
                <p style="text-align:left;margin-top:0;">
					<?php esc_attr_e( 'Please install the Kirki plugin to take full advantage of this theme\'s customizer capabilities', 'startup-pro' ); ?>
                </p>
                <a class="install-now button-primary button" data-slug="kirki"
                   href="<?php echo esc_url_raw( $this->get_plugin_install_url() ); ?>"
                   aria-label="<?php esc_attr_e( 'Install Kirki Toolkit now', 'startup-pro' ); ?>"
                   data-name="Kirki Toolkit">
					<?php esc_html_e( 'Install Now', 'startup-pro' ); ?>
                </a>
				<?php
			}

			/**
			 * Adds the install button.
			 *
			 * @since 1.0.0
			 * @return void
			 */
			protected function activate_button() {
				?>
                <p style="text-align:left;margin-top:0;">
					<?php esc_attr_e( 'You have installed Kirki. Activate it to take advantage of this theme\'s features in the customizer.', 'startup-pro' ); ?>
                </p>
                <a class="activate-now button-primary button" data-slug="kirki"
                   href="<?php echo esc_url_raw( self_admin_url( 'plugins.php' ) ); ?>"
                   aria-label="<?php esc_attr_e( 'Activate Kirki Toolkit now', 'startup-pro' ); ?>"
                   data-name="Kirki Toolkit">
					<?php esc_html_e( 'Activate Now', 'startup-pro' ); ?>
                </a>
				<?php
			}

			/**
			 * Adds the dismiss button and script.
			 *
			 * @since 1.0.0
			 * @return void
			 */
			protected function dismiss_button() {

				// Create the nonce.
				$ajax_nonce = wp_create_nonce( 'dismiss-kirki-recommendation' );

				// Show confirmation dialog on dismiss?
				$show_confirm = true;
				?>
                <a class="kirki-installer-dismiss button-secondary button"
                   data-slug="kirki" href="#"
                   aria-label="<?php esc_attr_e( 'Don\'t show this again', 'startup-pro' ); ?>"
                   data-name="<?php esc_attr_e( 'Dismiss', 'startup-pro' ); ?>">
					<?php esc_attr_e( 'Don\'t show this again', 'startup-pro' ); ?>
                </a>

                <script type="text/javascript">
                    jQuery(document).ready(function () {
                        jQuery('.kirki-installer-dismiss').on('click', function (event) {

                            event.preventDefault();

							<?php if ( $show_confirm ) : ?>
                            if (!confirm('<?php esc_attr_e( 'Are you sure? Dismissing this message will hide the installation recommendation and you will have to manually install and activate the plugin in the future.', 'startup-pro' ); ?>')) {
                                return;
                            }
							<?php endif; ?>

                            jQuery.post(ajaxurl, {
                                action: 'kirki_installer_dismiss',
                                security: '<?php echo esc_attr( $ajax_nonce ); ?>',
                            }, function (response) {
                                jQuery('#accordion-section-kirki_installer').remove();
                            });
                        });
                    });
                </script>
				<?php
			}

			/**
			 * Get the plugin install URL.
			 *
			 * @access private
			 * @return string
			 */
			private function get_plugin_install_url() {
				if ( ! $this->plugin_install_url ) {
					// Get the plugin-installation URL.
					$this->plugin_install_url = add_query_arg(
						array(
							'action' => 'install-plugin',
							'plugin' => 'kirki',
						),
						self_admin_url( 'update.php' )
					);
					$this->plugin_install_url = wp_nonce_url( $this->plugin_install_url, 'install-plugin_kirki' );
				}

				return $this->plugin_install_url;
			}
		}
	}

	// Early exit if the user has dismissed the notice.
	if ( is_callable( array(
			'Kirki_Installer_Section',
			'is_dismissed'
		) ) && Kirki_Installer_Section::is_dismissed() ) {
		return;
	}

	$wp_customize->add_section(
		new Kirki_Installer_Section(
			$wp_customize, 'kirki_installer', array(
				'title'      => '',
				'capability' => 'install_plugins',
				'priority'   => 0,
			)
		)
	);
	$wp_customize->add_setting(
		'kirki_installer_setting', array(
			'sanitize_callback' => '__return_true',
		)
	);
	$wp_customize->add_control(
		'kirki_installer_control', array(
			'section'  => 'kirki_installer',
			'settings' => 'kirki_installer_setting',
		)
	);

}

add_action( 'wp_ajax_kirki_installer_dismiss', 'startup_kirki_installer_dismiss' );
/**
 * Handles dismissing the plugin-install/activate recommendation.
 * If the user clicks the "Don't show this again" button, save as user-meta.
 *
 * @since 1.1.0
 *
 * @return void
 */
function startup_kirki_installer_dismiss() {
	check_ajax_referer( 'dismiss-kirki-recommendation', 'security' );
	$user_id = get_current_user_id();

	if ( update_user_meta( $user_id, 'dismiss-kirki-recommendation', true ) ) {
		echo 'success! :-)';
		wp_die();
	}

	echo 'failed :-(';
	wp_die();
}
