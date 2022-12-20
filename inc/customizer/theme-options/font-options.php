<?php

/**
 * Font section
 */

// Font section.
$wp_customize->add_section(
	'collective_news_font_options',
	array(
		'title' => esc_html__( 'Font ( Typography ) Options', 'collective-news' ),
		'panel' => 'collective_news_theme_options_panel',
	)
);

// Typography - Site Title Font.
$wp_customize->add_setting(
	'collective_news_site_title_font',
	array(
		'default'           => '',
		'sanitize_callback' => 'collective_news_sanitize_google_fonts',
	)
);

$wp_customize->add_control(
	'collective_news_site_title_font',
	array(
		'label'    => esc_html__( 'Site Title Font Family', 'collective-news' ),
		'section'  => 'collective_news_font_options',
		'settings' => 'collective_news_site_title_font',
		'type'     => 'select',
		'choices'  => collective_news_font_choices(),
	)
);

// Typography - Site Description Font.
$wp_customize->add_setting(
	'collective_news_site_description_font',
	array(
		'default'           => '',
		'sanitize_callback' => 'collective_news_sanitize_google_fonts',
	)
);

$wp_customize->add_control(
	'collective_news_site_description_font',
	array(
		'label'    => esc_html__( 'Site Description Font Family', 'collective-news' ),
		'section'  => 'collective_news_font_options',
		'settings' => 'collective_news_site_description_font',
		'type'     => 'select',
		'choices'  => collective_news_font_choices(),
	)
);

// Typography - Header Font.
$wp_customize->add_setting(
	'collective_news_header_font',
	array(
		'default'           => '',
		'sanitize_callback' => 'collective_news_sanitize_google_fonts',
	)
);

$wp_customize->add_control(
	'collective_news_header_font',
	array(
		'label'    => esc_html__( 'Header Font Family', 'collective-news' ),
		'section'  => 'collective_news_font_options',
		'settings' => 'collective_news_header_font',
		'type'     => 'select',
		'choices'  => collective_news_font_choices(),
	)
);

// Typography - Body Font.
$wp_customize->add_setting(
	'collective_news_body_font',
	array(
		'default'           => '',
		'sanitize_callback' => 'collective_news_sanitize_google_fonts',
	)
);

$wp_customize->add_control(
	'collective_news_body_font',
	array(
		'label'    => esc_html__( 'Body Font Family', 'collective-news' ),
		'section'  => 'collective_news_font_options',
		'settings' => 'collective_news_body_font',
		'type'     => 'select',
		'choices'  => collective_news_font_choices(),
	)
);
