<?php
/**
 * Back To Top settings
 */

$wp_customize->add_section(
	'collective_news_back_to_top_section',
	array(
		'title' => esc_html__( 'Scroll Up ( Back To Top )', 'collective-news' ),
		'panel' => 'collective_news_theme_options_panel',
	)
);

// Scroll to top enable setting.
$wp_customize->add_setting(
	'collective_news_enable_scroll_to_top',
	array(
		'default'           => true,
		'sanitize_callback' => 'collective_news_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	new Collective_News_Toggle_Checkbox_Custom_control(
		$wp_customize,
		'collective_news_enable_scroll_to_top',
		array(
			'label'    => esc_html__( 'Enable scroll to top.', 'collective-news' ),
			'settings' => 'collective_news_enable_scroll_to_top',
			'section'  => 'collective_news_back_to_top_section',
			'type'     => 'checkbox',
		)
	)
);
