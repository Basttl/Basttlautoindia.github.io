<?php
/**
 * Header Options settings
 */

$wp_customize->add_section(
	'collective_news_header_options_section',
	array(
		'title' => esc_html__( 'Header Options', 'collective-news' ),
		'panel' => 'collective_news_theme_options_panel',
	)
);

// Enable topbar Options.
$wp_customize->add_setting(
	'collective_news_enable_topbar',
	array(
		'default'           => true,
		'sanitize_callback' => 'collective_news_sanitize_checkbox',
	)
);

$wp_customize->add_control(
	new Collective_News_Toggle_Checkbox_Custom_control(
		$wp_customize,
		'collective_news_enable_topbar',
		array(
			'label'    => esc_html__( 'Enable Topbar.', 'collective-news' ),
			'section'  => 'collective_news_header_options_section',
			'settings' => 'collective_news_enable_topbar',
			'type'     => 'checkbox',
		)
	)
);

// Header Section Advertisement Image.
$wp_customize->add_setting(
	'collective_news_advertisement_image',
	array(
		'default'           => '',
		'sanitize_callback' => 'collective_news_sanitize_image',
	)
);

$wp_customize->add_control(
	new WP_Customize_Image_Control(
		$wp_customize,
		'collective_news_advertisement_image',
		array(
			'label'    => esc_html__( 'Advertisement Image', 'collective-news' ),
			'settings' => 'collective_news_advertisement_image',
			'section'  => 'collective_news_header_options_section',
		)
	)
);

// Header Advertisement Url.
$wp_customize->add_setting(
	'collective_news_advertisement_url',
	array(
		'default'           => '#',
		'sanitize_callback' => 'esc_url_raw',
	)
);

$wp_customize->add_control(
	'collective_news_advertisement_url',
	array(
		'label'    => esc_html__( 'Advertisement Url', 'collective-news' ),
		'settings' => 'collective_news_advertisement_url',
		'section'  => 'collective_news_header_options_section',
		'type'     => 'url',
	)
);
