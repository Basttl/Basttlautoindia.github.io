<?php
/**
 * Sidebar settings.
 */

$wp_customize->add_section(
	'collective_news_sidebar_option',
	array(
		'title' => esc_html__( 'Sidebar Options', 'collective-news' ),
		'panel' => 'collective_news_theme_options_panel',
	)
);

// Sidebar Option - Global Sidebar Position.
$wp_customize->add_setting(
	'collective_news_sidebar_position',
	array(
		'sanitize_callback' => 'collective_news_sanitize_select',
		'default'           => 'right-sidebar',
	)
);

$wp_customize->add_control(
	'collective_news_sidebar_position',
	array(
		'label'   => esc_html__( 'Global Sidebar Position', 'collective-news' ),
		'section' => 'collective_news_sidebar_option',
		'type'    => 'select',
		'choices' => array(
			'right-sidebar' => esc_html__( 'Right Sidebar', 'collective-news' ),
			'no-sidebar'    => esc_html__( 'No Sidebar', 'collective-news' ),
		),
	)
);

// Sidebar Option - Post Sidebar Position.
$wp_customize->add_setting(
	'collective_news_post_sidebar_position',
	array(
		'sanitize_callback' => 'collective_news_sanitize_select',
		'default'           => 'right-sidebar',
	)
);

$wp_customize->add_control(
	'collective_news_post_sidebar_position',
	array(
		'label'   => esc_html__( 'Post Sidebar Position', 'collective-news' ),
		'section' => 'collective_news_sidebar_option',
		'type'    => 'select',
		'choices' => array(
			'right-sidebar' => esc_html__( 'Right Sidebar', 'collective-news' ),
			'no-sidebar'    => esc_html__( 'No Sidebar', 'collective-news' ),
		),
	)
);

// Sidebar Option - Page Sidebar Position.
$wp_customize->add_setting(
	'collective_news_page_sidebar_position',
	array(
		'sanitize_callback' => 'collective_news_sanitize_select',
		'default'           => 'right-sidebar',
	)
);

$wp_customize->add_control(
	'collective_news_page_sidebar_position',
	array(
		'label'   => esc_html__( 'Page Sidebar Position', 'collective-news' ),
		'section' => 'collective_news_sidebar_option',
		'type'    => 'select',
		'choices' => array(
			'right-sidebar' => esc_html__( 'Right Sidebar', 'collective-news' ),
			'no-sidebar'    => esc_html__( 'No Sidebar', 'collective-news' ),
		),
	)
);
