<?php

$startup_buttons = implode( ',', [
	'button',
	'.button',
	'a.button',
	'[type="button"]',
	'[type="reset"]',
	'[type="submit"]',
	'.pagination .active a',
	'.wp-block-button .wp-block-button__link',
	'.ab-block-cta .ab-button',
	'.woocommerce a.button',
	'.woocommerce a.button.alt',
	'.woocommerce button.button',
	'.woocommerce button.button.alt',
	'.woocommerce input.button',
	'.woocommerce input.button.alt',
	'.woocommerce input.button[type="submit"]',
	'.woocommerce #respond input#submit',
	'.woocommerce #respond input#submit.alt',
	'.woocommerce #respond input#submit:hover',
	'.woocommerce a.button:hover',
	'.woocommerce button.button:hover',
	'.woocommerce input.button:hover',
	'.woocommerce nav.woocommerce-pagination ul li a:focus',
	'.woocommerce nav.woocommerce-pagination ul li a:hover',
	'.woocommerce nav.woocommerce-pagination ul li span.current',
	'.woocommerce ul.products li.product .button:hover',
	'.woocommerce ul.products li.product .button:focus',
	'.woocommerce ul.products li.product .button:active',
] );

$startup_gradient = implode( ',', [
	'.front-page-1',
	'.hero-section',
	'.front-page-3 .widget_media_video:before',
	'.front-page-3 .widget_media_image:before',
	'.front-page-3 .widget_media_gallery:before',
] );

$startup_links = implode( ',', [
	'a',
	'.sub-menu .menu-item-link',
	'.woocommerce ul.products li.product a',
	'.footer-widget-area .menu-item a',
] );

$startup_links_hover = implode( ',', [
	'a:hover',
	'a:focus',
	'.sub-menu .menu-item-link:hover',
	'.sub-menu .menu-item-link:focus',
	'.woocommerce ul.products li.product a:hover',
	'.woocommerce ul.products li.product a:focus',
	'.footer-widget-area .menu-item a:hover',
	'.footer-widget-area .menu-item a:focus',
	'.site-footer a:hover',
	'.site-footer a:focus',
	'.hero-section a:hover',
	'.hero-section a:focus',
	'.ab-block-post-grid h2 a:hover',
	'.ab-text-link:hover',
] );

return [
	[
		'type'     => 'color',
		'settings' => 'startup_color_button_left',
		'label'    => esc_attr__( 'Button Left Color', 'startup-pro' ),
		'section'  => 'colors',
		'default'  => '#825aff',
		'output'   => [
			[
				'element'         => $startup_buttons,
				'property'        => 'background',
				'value_pattern'   => 'linear-gradient(135deg, $ 0%, rightColor 100%)',
				'pattern_replace' => [
					'rightColor' => 'startup_color_button_right',
				],
			],
		],
	],
	[
		'type'     => 'color',
		'settings' => 'startup_color_button_right',
		'label'    => esc_attr__( 'Button Right Color', 'startup-pro' ),
		'section'  => 'colors',
		'default'  => '#7448ff',
		'output'   => [
			[
				'element'         => $startup_buttons,
				'property'        => 'background',
				'value_pattern'   => 'linear-gradient(135deg, leftColor 0%, $ 100%)',
				'pattern_replace' => [
					'leftColor' => 'startup_color_button_left',
				],
			],
			[
				'element'  => '.button.white, .button.outline, a.button.outline, button.white, button.outline, .outline a, a.button.white, .white a, .outline a, .white a:hover, .outline a:hover, .white a:focus, .outline a:focus',
				'property' => 'color',
			],
			[
				'element'  => '.button.outline, button.outline, a.button.outline',
				'property' => 'border-color',
			],
		],
	],
	[
		'type'     => 'color',
		'settings' => 'startup_color_link',
		'label'    => esc_attr__( 'Link Color', 'startup-pro' ),
		'section'  => 'colors',
		'default'  => '#7448ff',
		'output'   => [
			[
				'element'  => $startup_links_hover,
				'property' => 'color',
			],
			[
				'element'  => $startup_links,
				'property' => 'text-decoration-color',
			],
		],
	],
	[
		'type'     => 'color',
		'settings' => 'startup_color_hero_left',
		'label'    => esc_attr__( 'Hero Section Left Color', 'startup-pro' ),
		'section'  => 'colors',
		'default'  => '#8566ea',
		'output'   => [
			[
				'element'         => $startup_gradient,
				'property'        => 'background',
				'value_pattern'   => 'linear-gradient(135deg, $ 0%, rightColor 100%)',
				'pattern_replace' => [
					'rightColor' => 'startup_color_hero_right',
				],
			],
		],
	],
	[
		'type'     => 'color',
		'settings' => 'startup_color_hero_right',
		'label'    => esc_attr__( 'Hero Section Right Color', 'startup-pro' ),
		'section'  => 'colors',
		'default'  => '#7448ff',
		'output'   => [
			[
				'element'         => $startup_gradient,
				'property'        => 'background',
				'value_pattern'   => 'linear-gradient(135deg, leftColor 0%, $ 100%)',
				'pattern_replace' => [
					'leftColor' => 'startup_color_hero_left',
				],
			],
		],
	],
	[
		'type'     => 'color',
		'settings' => 'startup_color_hero_text',
		'label'    => esc_attr__( 'Hero Text Color', 'startup-pro' ),
		'section'  => 'colors',
		'default'  => '#ffffff',
		'output'   => [
			[
				'element'  => '.site-title a, .site-description, .hero-section, .hero-section p, .front-page-1, .front-page-1 p, .hero-section a, .front-page-1 a, .hero-section .search-form input, .edd_empty_cart',
				'property' => 'color',
			],
			[
				'element'     => '.menu-item-link, .menu-item-link:hover, .menu-item-link:focus',
				'property'    => 'color',
				'media_query' => '@media (min-width:896px)',
			],
			[
				'element'  => '.menu-toggle .hamburger, .menu-toggle .hamburger:before, .menu-toggle .hamburger:after',
				'property' => 'background-color',
			],
		],
	],
	[
		'type'     => 'color',
		'settings' => 'startup_color_footer',
		'label'    => esc_attr__( 'Footer Background Color', 'startup-pro' ),
		'section'  => 'colors',
		'default'  => '#f7f8fa',
		'output'   => [
			[
				'element'  => '.site-footer',
				'property' => 'background',
			],
		],
	],
	[
		'type'     => 'color',
		'settings' => 'startup_color_footer_text',
		'label'    => esc_attr__( 'Footer Text Color', 'startup-pro' ),
		'section'  => 'colors',
		'default'  => '#4b657e',
		'output'   => [
			[
				'element'  => '.site-footer, .site-footer .widget-title, .site-footer a, .site-footer .menu-item-link',
				'property' => 'color',
			],
		],
	],
	[
		'type'          => 'checkbox',
		'settings'      => 'startup_show_description',
		'label'         => __( 'Display Tagline', 'startup-pro' ),
		'section'       => 'title_tagline',
		'default'       => 10,
		'priority     ' => 25,
		'default'       => false,
	],
	[
		'type'          => 'number',
		'settings'      => 'startup_header_opacity',
		'label'         => __( 'Header Media Opacity', 'startup-pro' ),
		'section'       => 'header_image',
		'default'       => 10,
		'priority     ' => 1,
		'choices'       => [
			'min'  => 0,
			'max'  => 1,
			'step' => 0.1,
		],
		'output'        => [
			[
				'element'  => '.wp-custom-header, div.hero-background',
				'property' => 'opacity',
			],
		],
	],
	[
		'type'     => 'checkbox',
		'settings' => 'single_post_featured_image',
		'label'    => __( 'Display featured image on singular blog posts?', 'startup-pro' ),
		'tooltip'    => __( 'Check this setting to display post featured images above the post content on singular blog posts.', 'startup-pro' ),
		'section'  => CHILD_THEME_HANDLE,
		'default'  => true,
	],
	[
		'type'     => 'checkbox',
		'settings' => 'single_page_hero_background',
		'label'    => __( 'Use featured image as hero section background?', 'startup-pro' ),
		'tooltip'    => __( 'Check this setting to enable post and page featured images to be used as the hero section background image.', 'startup-pro' ),
		'section'  => CHILD_THEME_HANDLE,
		'default'  => false,
	],
	[
		'type'     => 'checkbox',
		'settings' => 'single_page_hero_fallback',
		'label'    => __( 'Use Header Media image as hero section fallback?', 'startup-pro' ),
		'tooltip'    => __( 'Check this setting to use the Header Media image as the hero section background image if no featured image exists. Header Media can be set from Appearance → Customize → Header Media.', 'startup-pro' ),
		'section'  => CHILD_THEME_HANDLE,
		'default'  => false,
	],
	[
		'type'     => 'slider',
		'settings' => 'startup_gradient_angle',
		'label'    => __( 'Gradient Angle', 'startup-pro' ),
		'tooltip'    => __( 'Select the direction for the hero section and button gradient angle.', 'startup-pro' ),
		'section'  => CHILD_THEME_HANDLE,
		'default'  => 135,
		'choices'  => [
			'min'  => 0,
			'max'  => 360,
			'step' => 1,
		],
		'output'   => [
			[
				'element'         => $startup_buttons,
				'property'        => 'background',
				'value_pattern'   => 'linear-gradient($deg, leftColor 0%, rightColor 100%)',
				'pattern_replace' => [
					'leftColor'  => 'startup_color_button_left',
					'rightColor' => 'startup_color_button_right',
				],
			],
			[
				'element'         => $startup_gradient,
				'property'        => 'background',
				'value_pattern'   => 'linear-gradient($deg, leftColor 0%, rightColor 100%)',
				'pattern_replace' => [
					'leftColor'  => 'startup_color_hero_left',
					'rightColor' => 'startup_color_hero_right',
				],
			],
		],
	],
	[
		'type'     => 'number',
		'settings' => 'startup_button_radius',
		'label'    => __( 'Button Border Radius', 'startup-pro' ),
		'section'  => CHILD_THEME_HANDLE,
		'default'  => 28,
		'choices'  => [
			'min'  => 0,
			'max'  => 28,
			'step' => 1,
		],
		'output'   => [
			[
				'element'       => 'button, .button, a.button, [type="button"], [type="reset"], [type="submit"], input, select, textarea, .select2-container--default .select2-selection--single, .woocommerce a.button, .woocommerce a.button.alt, .woocommerce button.button, .woocommerce button.button.alt, .woocommerce input.button, .woocommerce input.button.alt, .woocommerce input.button[type=\'submit\'], .woocommerce #respond input#submit, .woocommerce #respond input#submit.alt, .pagination a',
				'property'      => 'border-radius',
				'value_pattern' => '$px',
			],
		],
	],
	[
		'type'     => 'select',
		'settings' => 'startup_hero_divider',
		'label'    => __( 'Hero Section Divider', 'startup-pro' ),
		'section'  => CHILD_THEME_HANDLE,
		'default'  => 'curve',
		'choices'  => [
			'none'  => esc_attr__( 'None', 'startup-pro' ),
			'curve' => esc_attr__( 'Curve', 'startup-pro' ),
			'angle' => esc_attr__( 'Angle', 'startup-pro' ),
			'wave'  => esc_attr__( 'Wave', 'startup-pro' ),
		],
	],
	[
		'type'     => 'select',
		'settings' => 'startup_hero_search_style',
		'label'    => __( 'Hero Section Search Style', 'startup-pro' ),
		'section'  => CHILD_THEME_HANDLE,
		'default'  => 'light',
		'choices'  => [
			'light' => esc_attr__( 'Light', 'startup-pro' ),
			'dark'  => esc_attr__( 'Dark', 'startup-pro' ),
		],
	],
	[
		'type'     => 'select',
		'settings' => 'startup_front_page_1_text_align',
		'label'    => __( 'Front Page 1 Text Alignment', 'startup-pro' ),
		'section'  => CHILD_THEME_HANDLE,
		'default'  => 'left',
		'choices'  => [
			'left'   => esc_attr__( 'Left', 'startup-pro' ),
			'center' => esc_attr__( 'Center', 'startup-pro' ),
			'right'  => esc_attr__( 'Right', 'startup-pro' ),
		],
		'output'   => [
			[
				'element'  => '.front-page-1 .widget',
				'property' => 'text-align',
			],
		],
	],
	[
		'type'     => 'select',
		'settings' => 'startup_front_page_1_video_style',
		'label'    => __( 'Front Page 1 Video Style', 'startup-pro' ),
		'section'  => CHILD_THEME_HANDLE,
		'default'  => 'browser',
		'choices'  => [
			'none'    => esc_attr__( 'None', 'startup-pro' ),
			'browser' => esc_attr__( 'Browser', 'startup-pro' ),
		],
	],
];
