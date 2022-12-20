<?php

/**
 * Color Options
 */

// Site tagline color setting.
$wp_customize->add_setting(
	'collective_news_header_tagline',
	array(
		'default'           => '#404040',
		'sanitize_callback' => 'collective_news_sanitize_hex_color',
	)
);

$wp_customize->add_control(
	new WP_Customize_Color_Control(
		$wp_customize,
		'collective_news_header_tagline',
		array(
			'label'   => esc_html__( 'Site tagline Color', 'collective-news' ),
			'section' => 'colors',
		)
	)
);
