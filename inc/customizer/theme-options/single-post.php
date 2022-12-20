<?php
/**
 * Single Post Options
 */

$wp_customize->add_section(
	'collective_news_single_page_options',
	array(
		'title' => esc_html__( 'Single Post Options', 'collective-news' ),
		'panel' => 'collective_news_theme_options_panel',
	)
);

// Enable single post category setting.
$wp_customize->add_setting(
	'collective_news_enable_single_category',
	array(
		'default'           => true,
		'sanitize_callback' => 'collective_news_sanitize_checkbox',
	)
);

$wp_customize->add_control(
	new Collective_News_Toggle_Checkbox_Custom_control(
		$wp_customize,
		'collective_news_enable_single_category',
		array(
			'label'    => esc_html__( 'Enable Category', 'collective-news' ),
			'settings' => 'collective_news_enable_single_category',
			'section'  => 'collective_news_single_page_options',
			'type'     => 'checkbox',
		)
	)
);

// Enable single post author setting.
$wp_customize->add_setting(
	'collective_news_enable_single_author',
	array(
		'default'           => true,
		'sanitize_callback' => 'collective_news_sanitize_checkbox',
	)
);

$wp_customize->add_control(
	new Collective_News_Toggle_Checkbox_Custom_control(
		$wp_customize,
		'collective_news_enable_single_author',
		array(
			'label'    => esc_html__( 'Enable Author', 'collective-news' ),
			'settings' => 'collective_news_enable_single_author',
			'section'  => 'collective_news_single_page_options',
			'type'     => 'checkbox',
		)
	)
);

// Enable single post date setting.
$wp_customize->add_setting(
	'collective_news_enable_single_date',
	array(
		'default'           => true,
		'sanitize_callback' => 'collective_news_sanitize_checkbox',
	)
);

$wp_customize->add_control(
	new Collective_News_Toggle_Checkbox_Custom_control(
		$wp_customize,
		'collective_news_enable_single_date',
		array(
			'label'    => esc_html__( 'Enable Date', 'collective-news' ),
			'settings' => 'collective_news_enable_single_date',
			'section'  => 'collective_news_single_page_options',
			'type'     => 'checkbox',
		)
	)
);

// Enable single post title setting.
$wp_customize->add_setting(
	'collective_news_enable_single_post_title',
	array(
		'default'           => true,
		'sanitize_callback' => 'collective_news_sanitize_checkbox',
	)
);

$wp_customize->add_control(
	new Collective_News_Toggle_Checkbox_Custom_control(
		$wp_customize,
		'collective_news_enable_single_post_title',
		array(
			'label'    => esc_html__( 'Enable Post Title', 'collective-news' ),
			'settings' => 'collective_news_enable_single_post_title',
			'section'  => 'collective_news_single_page_options',
			'type'     => 'checkbox',
		)
	)
);

// Enable single post related Posts setting.
$wp_customize->add_setting(
	'collective_news_enable_single_post_related_posts',
	array(
		'default'           => true,
		'sanitize_callback' => 'collective_news_sanitize_checkbox',
	)
);

$wp_customize->add_control(
	new Collective_News_Toggle_Checkbox_Custom_control(
		$wp_customize,
		'collective_news_enable_single_post_related_posts',
		array(
			'label'    => esc_html__( 'Enable Related posts', 'collective-news' ),
			'settings' => 'collective_news_enable_single_post_related_posts',
			'section'  => 'collective_news_single_page_options',
			'type'     => 'checkbox',
		)
	)
);

// Single post related Posts title label.
$wp_customize->add_setting(
	'collective_news_related_posts_title',
	array(
		'default'           => __( 'Related Posts', 'collective-news' ),
		'sanitize_callback' => 'sanitize_text_field',
	)
);

$wp_customize->add_control(
	'collective_news_related_posts_title',
	array(
		'label'           => esc_html__( 'Related Posts Title', 'collective-news' ),
		'section'         => 'collective_news_single_page_options',
		'settings'        => 'collective_news_related_posts_title',
		'active_callback' => function( $control ) {
			return ( $control->manager->get_setting( 'collective_news_enable_single_post_related_posts' )->value() );
		},
	)
);
