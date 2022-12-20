<?php
/**
 * Frontpage Sidebar settings
 */

$wp_customize->add_section(
	'collective_news_frontpage_sidebar_option',
	array(
		'title' => esc_html__( 'Frontpage Sidebar Position', 'collective-news' ),
		'panel' => 'collective_news_theme_options_panel',
	)
);

// Below Banner Secondary Sidebar Option - Sidebar Position.
$wp_customize->add_setting(
	'collective_news_below_banner_secondary_sidebar_position',
	array(
		'sanitize_callback' => 'collective_news_sanitize_select',
		'default'           => 'secondary-right-position',
	)
);

$wp_customize->add_control(
	'collective_news_below_banner_secondary_sidebar_position',
	array(
		'label'   => esc_html__( 'Below Banner Secondary Sidebar Position', 'collective-news' ),
		'section' => 'collective_news_frontpage_sidebar_option',
		'type'    => 'select',
		'choices' => array(
			'secondary-right-position' => esc_html__( 'Shift Right Position', 'collective-news' ),
			'secondary-left-position'  => esc_html__( 'Shift Left Position', 'collective-news' ),
		),
	)
);
