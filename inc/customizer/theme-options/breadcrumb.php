<?php
/**
 * Breadcrumb settings
 */

$wp_customize->add_section(
	'collective_news_breadcrumb_section',
	array(
		'title' => esc_html__( 'Breadcrumb Options', 'collective-news' ),
		'panel' => 'collective_news_theme_options_panel',
	)
);

// Breadcrumb enable setting.
$wp_customize->add_setting(
	'collective_news_breadcrumb_enable',
	array(
		'default'           => true,
		'sanitize_callback' => 'collective_news_sanitize_checkbox',
	)
);

$wp_customize->add_control(
	new Collective_News_Toggle_Checkbox_Custom_control(
		$wp_customize,
		'collective_news_breadcrumb_enable',
		array(
			'label'    => esc_html__( 'Enable breadcrumb.', 'collective-news' ),
			'type'     => 'checkbox',
			'settings' => 'collective_news_breadcrumb_enable',
			'section'  => 'collective_news_breadcrumb_section',
		)
	)
);

// Breadcrumb - Separator.
$wp_customize->add_setting(
	'collective_news_breadcrumb_separator',
	array(
		'sanitize_callback' => 'sanitize_text_field',
		'default'           => '/',
	)
);

$wp_customize->add_control(
	'collective_news_breadcrumb_separator',
	array(
		'label'           => esc_html__( 'Separator', 'collective-news' ),
		'section'         => 'collective_news_breadcrumb_section',
		'active_callback' => function( $control ) {
			return ( $control->manager->get_setting( 'collective_news_breadcrumb_enable' )->value() );
		},
	)
);
