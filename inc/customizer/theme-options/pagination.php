<?php
/**
 * Pagination setting
 */

// Pagination setting.
$wp_customize->add_section(
	'collective_news_pagination',
	array(
		'title' => esc_html__( 'Pagination', 'collective-news' ),
		'panel' => 'collective_news_theme_options_panel',
	)
);

// Pagination enable setting.
$wp_customize->add_setting(
	'collective_news_pagination_enable',
	array(
		'default'           => true,
		'sanitize_callback' => 'collective_news_sanitize_checkbox',
	)
);

$wp_customize->add_control(
	new Collective_News_Toggle_Checkbox_Custom_control(
		$wp_customize,
		'collective_news_pagination_enable',
		array(
			'label'    => esc_html__( 'Enable Pagination.', 'collective-news' ),
			'settings' => 'collective_news_pagination_enable',
			'section'  => 'collective_news_pagination',
			'type'     => 'checkbox',
		)
	)
);

// Pagination - Pagination Style.
$wp_customize->add_setting(
	'collective_news_pagination_type',
	array(
		'default'           => 'default',
		'sanitize_callback' => 'collective_news_sanitize_select',
	)
);

$wp_customize->add_control(
	'collective_news_pagination_type',
	array(
		'label'           => esc_html__( 'Pagination Style', 'collective-news' ),
		'section'         => 'collective_news_pagination',
		'type'            => 'select',
		'choices'         => array(
			'default' => __( 'Default (Older/Newer)', 'collective-news' ),
			'numeric' => __( 'Numeric', 'collective-news' ),
		),
		'active_callback' => function( $control ) {
			return ( $control->manager->get_setting( 'collective_news_pagination_enable' )->value() );
		},
	)
);
